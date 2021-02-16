<?php

namespace App\DataFixtures;

use App\Entity\Competence;
use App\Entity\GroupeCompetences;
use App\Entity\GroupeTags;
use App\Entity\Niveau;
use Faker\Factory;
use App\Entity\User;
use App\Entity\Profil;
use App\Entity\Tags;
use App\Repository\ProfilRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture

{

    private $encode;
    private $profils;

    public function __construct(UserPasswordEncoderInterface $encode,ProfilRepository $ProfilSortie)
    {
        $this->encode = $encode;
        $this->profils = $ProfilSortie;
        
    } 
    public function load(ObjectManager $manager)
    {
        /*
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');
        $profils=["ADMIN","FORMATEUR","APPRENANT","CM"];
       foreach ($profils as $key => $libelle) {
                $profil =new Profil();  
                $profil ->setLibelle($libelle);
                 $manager ->persist($profil);        
                 $manager ->flush();         
                for ($i=1; $i <=3 ; $i++) {           
                    $user = new User();           
                    $user ->setProfil($profil);
                    $user ->setEmail($faker->email);
                    $user ->setPrenom($faker->firstName);
                    $user->setIsdeleted("0");          
                    $user->setIsconnect("0");  
                     $user ->setNom($faker->name());           
                     //Génération des Users          
                      $password = $this->encode->encodePassword ($user, 'passer');           
                      $user ->setPassword($password);                      
                      $manager ->persist($user);                  
                     }

        $manager->flush();
       }
        */

    // à partir de là on va commencer les fixtures pour competence et groupe competences
      
      for ($i=0; $i < 2; $i++) { 
        $grpCompetence= new GroupeCompetences();
        $grpCompetence->setLibelle("groupe".$i);
        $grpCompetence->setDescription("descriptionGr".$i);
        

        for ($j=0; $j < 3; $j++) { 
            $competence= new Competence ();  
            $competence->setLibelle("competence".$j);
            $competence->setDescription("descriptionCompet".$j);
            $competence->setArchivage(0);

            $niveau= new Niveau;
            $niveau->setLibelle("niveau".$j);
            $niveau->setCritereEvaluation("critere".$j);
            $niveau->setGroupeActions("groupeACtion".$j);
            $competence->addNiveau($niveau);
            $manager->persist($competence); 
            $grpCompetence->addCompetence($competence);

        }
        $manager->persist($grpCompetence);
        $manager->flush();
         
      }

     // fin de la fixture competence et groupe competence
   
     for ($i=0; $i < 2; $i++) { 
        $grpTag= new GroupeTags();
        $grpTag->setLibelle("Groupe Tag".$i);
    
        

        for ($j=0; $j < 5; $j++) { 
            $tag= new Tags ();  
            $tag->setLibelle("Tag".$j);
            $tag->setDescription("Tag".$j);
            $tag->setArchivage(0);
            $grpTag->addTag($tag);
            $manager->persist($tag); 
                       
        }
        $manager->persist($grpTag);
        $manager->flush();
         
      }
     // debut de la fixture Tags et Groupe Tags 
      
     
     // Fin de la fixture Tags et Groupe Tags  
     

     // debut de la fixture groupe
     
     // fin fixture groupe
     
} // fin de la fonction load 
}