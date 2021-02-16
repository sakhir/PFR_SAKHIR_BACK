<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Entity\GroupeCompetences;
use App\Repository\CompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\GroupeCompetencesRepository;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupeCompetenceController extends AbstractController
{


    private $validator;
    private $em;
    private $groupe;
    private $competence;
    public function __construct(ValidatorInterface $validator, EntityManagerInterface $em,GroupeCompetencesRepository $groupe,CompetenceRepository $competence)
    {
        $this->validator = $validator;
        $this->em = $em;
        $this->groupe = $groupe;
        $this->competence = $competence;
    }
       //archiver competence  
       public function deleteComp(CompetenceRepository $repo,$id,EntityManagerInterface $em)
       {
           $comp = $repo->find($id);
           if ($this->isGranted('ROLE_ADMIN') && $comp != null) {
               $comp->setArchivage(1);
               $em->flush();
               return $this->json(' Competence deleted',Response::HTTP_OK); 
           }
           return $this->json("access refusé ou competence inexistante  !!!");
       }

       /*
cette fonction permet de tester gère les cas possibles lors de   l'ajout de groupe de competences qui sont:
    1-groupe de competence existe et competences not existe (on créé les competences   et on affecte au groupe)
    2-groupe competence not exist et competences existe (on cree le groupe et on lui affece des competences)
    3-groupe de competences et competences n'existe pas on crée les deux en meme temps 
    */
    
    public function createGroupeCompetence(Request $request)
    {
        $json = json_decode($request->getContent());
       
        
        //verifions s'il faut crée le groupe oubien l'affecté des competences
        if (isset($json->id)) {
         $groupeCompetences = $this->groupe->find($json->id);
         
        }else{
            $groupeCompetences = null;
        }
        if ($groupeCompetences != null) {
            //dans le cas ou groupe competence existe deja
            for ($i=0; $i < count($json->competences); $i++) { 
                if (isset($json->competences[$i]->id)) {
                    //affectation la/les competences au groupe
                    $competences = $this->competence->find($json->competences[$i]->id);
                    $groupeCompetences->addCompetence($competences);
                }else{
                    
                    //creation de la/les competences
                    $competences = new Competence;
                    $competences->setLibelle($json->competences[$i]->libelle)
                                ->setDescription($json->competences[$i]->description)
                                ->setArchivage(0)
                                 ;
                    $groupeCompetences->addCompetence($competences);
                   
                }
            }
        
            //validation competences avant mise a jour
          
            $erreurscompetences = $this->validator->validate($competences);
            if ($erreurscompetences) {
            
                return $this->json($erreurscompetences);
            }  
            //mettons a jour le bdd
            $this->em->flush();
        
            return $this->json('Compétence(s) ajoutée(s) dans ce groupe de compétence',Response::HTTP_OK);
        }else{ //si groupe de competence n'existe on crée
            $groupeCompetences = new GroupeCompetences;
                $groupeCompetences->setLibelle($json->libelle)
                                  ->setDescription($json->description);
            for ($i=0; $i < count($json->competences); $i++) { 
                if (isset($json->competences[$i]->id)) {
                    //affectation de la competence
                    $competences = $this->competence->find($json->competences[$i]->id);
                    $groupeCompetences->addCompetence($competences);
                }else{
                    //creation competence
                    $competences = new Competence;
                    $competences->setLibelle($json->competences[$i]->libelle)
                                ->setDescription($json->competences[$i]->description)
                                ->setArchivage(0);
                    $groupeCompetences->addCompetence($competences)
                    ;
                }
            }
            //validation groupe competences
            $erreurs = $this->validator->validate($groupeCompetences);
            if ($erreurs) {
                return $this->json($erreurs);
            }

            $this->em->persist($groupeCompetences);
            $this->em->flush();
            return $this->json('Groupe et compétence(s) ajoutés ',Response::HTTP_OK);
        }
    }



    // Creons une fonction qui permet de d editer un groupe de competence (ajouter une competence dans un groupe  )
    public function EditGroupeCompetence(Request $request , $id )
    {
        $json = json_decode($request->getContent());
        $groupeCompetences = $this->groupe->find($id);
           // Testons  si le  groupe de competence existe 
        if ($groupeCompetences != null) {
              
        
             // a partir de la je vais tester si le gars veut ajoujter une nouvelle connaissance ou Supprimer  une connaissance  
             // dans un groupe 
             
             if($json->button=="Add") {
              
                      // Ajoutons la competence dans le groupe 
                    //creation de la/les competences
                    $competences = new Competence;
                    
                    $competences->setLibelle($json->competences[0]->libelle)
                                ->setDescription($json->competences[0]->description)
                                ->setArchivage(0)
                                ;
                    //validation  competence
                    $erreurs = $this->validator->validate($competences);
                    if ($erreurs) {
                        return $this->json($erreurs);
                    } 

                    $groupeCompetences->addCompetence($competences);
                    $this->em->flush();
                    return $this->json('Competence Ajoutée dans le groupe selectionné   ',Response::HTTP_OK);
                
             }
             else if($json->button=="Delete") {
                 // le traitement si on veut supprimer 
                $nbr= count($json->competences);
                 
                 for ($i=0; $i <$nbr ; $i++) { 
                    $competences = $this->competence->find($json->competences[$i]->id);

                    $groupeCompetences->removeCompetence($competences);
                    $this->em->flush();
                    return $this->json('Compétence(s) supprimée(s) ',Response::HTTP_OK);
                 }

             }
             else {
                return $this->json('Veuillez Ajouter ou Supprimer une competence ',Response::HTTP_OK);     
             }
            
                    

        }
        else {
            return $this->json('Le groupe de competence n existe pas   ',Response::HTTP_OK);
        }


    }

}

    
