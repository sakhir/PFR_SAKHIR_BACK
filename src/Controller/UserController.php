<?php

namespace App\Controller;

use App\Entity\CM;
use App\Entity\User;
use App\Entity\Profil;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use App\Helper\UserHelper;
use PhpParser\Node\Expr\Cast;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\UserRepository;
use App\Repository\ProfilRepository;
use App\Repository\GroupesRepository;
use App\Repository\ApprenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProfilSortieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    
    private $security;
    private $em ;
    private $helper;
    private $repo ;
    private $profilRepo ;
    private $appRepo;

    public function __construct(Security $security ,EntityManagerInterface $em ,UserHelper $helper ,UserRepository $repo ,ProfilRepository $profilRepo ,ApprenantRepository $appRepo)
    {
        $this->security = $security;
        $this->em=$em ;
        $this->helper=$helper ;
        $this->repo=$repo ;
        $this->profilRepo=$profilRepo ;
        $this->appRepo=$appRepo;
    }


    // je vais commencer a partir de la à utiliser les services 
    // creeons une fonction addUser qui va creer tout type d utilisateur 
    
    public function addUser(UserHelper $helperUser, SerializerInterface $serializer ,Request $request  ) {
     $userpost =$request->request->all();
     if(isset($userpost['avatar'])){
         unset($userpost['avatar']);
     }
    
     $profil= $this->profilRepo->findByProfil($userpost['profil']);
       
     $profil="/api/admin/profils/".$profil[0]->getId();
     $userpost['profil'] =$profil ;
    

 
if($userpost['profil']=="/api/admin/profils/1") {
 
    $profilUser =$serializer->denormalize($userpost['profil'] ,User::class);      
    $v="App\Entity\\User";

   
}
 else if($userpost['profil']=="/api/admin/profils/4") {

    
    $profilUser =$serializer->denormalize($userpost['profil'] ,CM::class);
    $v="App\Entity\\CM";
 }
 else {
     
    $profilUser =$serializer->denormalize($userpost['profil'] ,Profil::class);
    $v="App\Entity\\".ucfirst(strtolower($profilUser->getLibelle()));
    
 
 }
 
     $user=$serializer->denormalize($userpost, $v,true);
     //dd($user);
    
    $helperUser->createUser($request,$user,$userpost,$profilUser);
    return $this->json('create',Response::HTTP_OK);

}




    public function EditUser($id,Request $request,SerializerInterface $serializer) {
        $data=$request->request->all();
        if(isset($data['avatar'])){
            unset($data['avatar']);
        }
        $user=$this->repo->find($id);
        foreach($data as $key=> $value) {
            $setProperty='set'.ucfirst($key);
        
            if($key!='profil' && $data['profil']!='APPRENANT' ) {
            
             if($setProperty!='setAdresse' && $setProperty!='setTelephone' && $setProperty!='setGenre'){
                $user->$setProperty($value);
             }
         
         }

        else {
              
           if($key=='adresse' || $key=='telephone' || $key=='genre' ) {

            $profilUser =$serializer->denormalize("/api/admin/profils/2" ,Apprenant::class);
            
            $v="App\Entity\\".ucfirst(strtolower($profilUser->getLibelle()));
            $tab=$data;
            $tab['profil']="/api/admin/profils/".$profilUser->getId();
           
            $user=$serializer->denormalize($tab, $v,true);

              } 
              
            }   
          
              
        }
       
      
         $profil=$this->profilRepo->findByLibelle($data['profil']);  
    
        $user->setProfil($profil[0]);
        $image=$this->helper->TRaiterImage($request);
        $user->setAvatar($image);
        $this->em->flush();
         return $this->json('Modification reuissie',Response::HTTP_OK);
    }

     //show all apprenants
     public function showApprenants(UserRepository $repo)
     {
         if($this->isGranted('ROLE_FORMATEUR') || $this->isGranted('ROLE_ADMIN')  || $this->isGranted('ROLE_CM')){
              $apprenants = $repo->findByProfil("APPRENANT");
             return $this->json($apprenants,200,[],['groups'=>'user:read']);
         }else{
             return $this->json("vous n'avez pas accès a cette resource ",403);
         }
     }
 
     //liste des formateurs
     public function showFormateurs(UserRepository $repo)
     {
         if($this->isGranted('ROLE_ADMIN')  || $this->isGranted('ROLE_CM')){
             $formateurs = $repo->findByProfil("FORMATEUR");
            return $this->json($formateurs,200,[],['groups'=>'user:read']);
        }else{
            return $this->json("vous n'avez pas accès a cette resource ",403);
        }
     }

        //get one apprenant by id
        public function findApprenantsById(UserRepository $repo,$id)
        {
            if($this->isGranted('ROLE_ADMIN') || $this->isGranted('ROLE_FORMATEUR') || $this->isGranted('ROLE_CM')){
                $apprenants = $repo->findOneById('APPRENANT', $id);
                if ($apprenants) {
                    return $this->json($apprenants,Response::HTTP_OK,[],['groups'=>"student:read"]);
                }else{
                    return $this->json("user n'est pas un apprenant");
                }
            }else {
                $apprenants = $repo->findOneById('APPRENANT', $id);
                
                $user=$this->security->getUser();
                if (!$apprenants) 
                { return $this->json("vous n'avez pas accès a cette resource ",403); }
                
               if ( $this->isGranted('ROLE_APPRENANT') && $apprenants->getId()==$user->getId() ) {
                    return $this->json($apprenants,Response::HTTP_OK,[],['groups'=>"student:read"]);
                  }else {
                    return $this->json("vous n'avez pas accès a cette resource ",403); 
                }
        
            } 
        }
    
    
  //get one formateur by id
  public function findFormateursById(UserRepository $repo,$id)
  {
      if($this->isGranted('ROLE_CM') || $this->isGranted('ROLE_ADMIN')){
          $formateurs = $repo->findOneById('FORMATEUR', $id);
          if ($formateurs) {
              return $this->json($formateurs,Response::HTTP_OK,[],['groups'=>'user:read']);
          }else{
              return $this->json("user n'est pas un formateur");
          }
      }

      else {
          $formateurs = $repo->findOneById('FORMATEUR', $id);
          $user=$this->security->getUser();
          if ($formateurs==null) 
          { return $this->json("vous n'avez pas accès a cette resource ",403); }
          
          if ( $this->isGranted('ROLE_FORMATEUR') && $user->getId()==$formateurs->getId() ) {
              return $this->json($formateurs,Response::HTTP_OK,[],['groups'=>'user:read']);
          }
          else {
              return $this->json("vous n'avez pas accès a cette resource ",403); 
          }
      }      
  }

 //edit apprenant by id
 public function editApprenant(UserRepository $repo,$id,Request $request, EntityManagerInterface $em, ValidatorInterface $validator)
 {
     $apprenantObject = $repo->findOneById('APPRENANT', $id);
     if($apprenantObject==null ) {
         return $this->json("vous n'avez pas accès a cette resource ",403); 
     }
     $user=$this->security->getUser();
     if($this->isGranted('ROLE_FORMATEUR') || $this->isGranted('ROLE_ADMIN') || ($this->isGranted('ROLE_APPRENANT') && $user->getId()==$apprenantObject->getId()) ){
         $jsonApprenant  = json_decode($request->getContent());
        
         $apprenantObject->setNom($jsonApprenant->nom);
         $apprenantObject->setPrenom($jsonApprenant->prenom);
         $apprenantObject->setEmail($jsonApprenant->email);

         if($apprenantObject){
             $erreurs = $validator->validate($apprenantObject);
             if (count($erreurs)>0) {
                 return $this->json('invalide',Response::HTTP_BAD_REQUEST);
             }
             $em->flush();
             return $this->json('success',Response::HTTP_OK);
         }else{
             return $this->json("user n'est pas un apprenant");
         }
     }else{
         return $this->json("vous n'avez pas accès a cette resource ",403);
     }
 }

 
     //editer un formateur
     public function editFormateur(UserRepository $repo,$id,Request $request, EntityManagerInterface $em, ValidatorInterface $validator)
     {
         $formateurObject = $repo->findOneById('FORMATEUR', $id);
         if($formateurObject==null ) {
             return $this->json("vous n'avez pas accès a cette resource ",403); 
         }
         $user=$this->security->getUser();
         if( ($this->isGranted('ROLE_FORMATEUR') && $user->getId()==$formateurObject->getId())  || $this->isGranted('ROLE_ADMIN') ){
 
             $jsonFormateur  = json_decode($request->getContent());
         
             $formateurObject->setNom($jsonFormateur->nom);
             $formateurObject->setPrenom($jsonFormateur->prenom);
             $formateurObject->setEmail($jsonFormateur->email);
 
             if($formateurObject){
                 $erreurs = $validator->validate($formateurObject);
                 if (count($erreurs)>0) {
                     return $this->json('invalide',Response::HTTP_BAD_REQUEST);
                 }
                 $em->flush();
                 return $this->json('success',Response::HTTP_OK);
             }else{
                 return $this->json("user n'est pas un formateur");
             }
         }else{
 
             return $this->json("vous n'avez pas accès a cette resource ",403);
         }
     }
  
    
       
    //archiver user 
    public function deleteUser(UserRepository $repo,$id,EntityManagerInterface $em)
    {
        $user = $repo->find($id);
        if ($this->isGranted('ROLE_ADMIN') && $user != null) {
            $user->setIsdeleted(1);
            $em->flush();
            return $this->json('deleted',Response::HTTP_OK); 
        }
        return $this->json("access denied or not user !!!");
    }


    //Delete profil   
    public function deleteProfil(ProfilRepository $repo,$id,EntityManagerInterface $em)
    {
        $profil = $repo->find($id);
        $users=$profil->getUsers();
        //dd(count($users));
      
        if ($this->isGranted('ROLE_ADMIN') && $profil != null) {
            $profil->setArchivage(1);
          
            foreach($users as $u){
                $u->setIsdeleted(1);
              }
            $em->flush();
            return $this->json('deleted',Response::HTTP_OK); 
        }
        return $this->json("access denied or not a profil  !!!");
    }  

    //deleteProfilSorti
    public function deleteProfilSorti(ProfilSortieRepository $repo,$id,EntityManagerInterface $em)
    {
        $profil = $repo->find($id);
        $users=$profil->getApprenants();
        //dd(count($users));
      
        if ($this->isGranted('ROLE_ADMIN') && $profil != null) {
            $profil->setArchivage(1);
          
            foreach($users as $u){
                $u->setProfilSortie(null);
              }
            $em->flush();
            return $this->json('profildeleted',Response::HTTP_OK); 
        }
        return $this->json("access denied or not a profil  !!!");
    } 





    //reintegrer  user 
    public function IntegrerUser(UserRepository $repo,$id,EntityManagerInterface $em)
    {
        $user = $repo->find($id);
        if ($this->isGranted('ROLE_ADMIN') && $user != null) {
            $user->setIsdeleted(0);
            $em->flush();
            return $this->json('Utilisateur réintegré',Response::HTTP_OK); 
        }
        return $this->json("access denied or not user !!!");
    }

     public function  UsersDeleted(UserRepository $repo)
     {

       
         $user = $repo->findDeleted();
       //  dd($user);
         if ($this->isGranted('ROLE_ADMIN') && $user != null) {

            if($user) {
               
                return $this->json($user,Response::HTTP_OK,[],['groups'=>"user:dl"]); 
            }
          
         }
         return $this->json("access denied or not user !!!");
     }
   
     //UsersActif
     public function  UsersActif(UserRepository $repo)
     {

         $user = $repo->findUsersActif();
         if ($this->isGranted('ROLE_ADMIN') && $user != null) {

            if($user) {
               
                return $this->json($user,Response::HTTP_OK,[],['groups'=>"user:read"]); 
            }
          
         }
         return $this->json("access denied or not user !!!");
     }

    // supprimer un apprenant dans un groupe 
    public function deleteAppGrpe(UserRepository $repo,$idg,$id, EntityManagerInterface $em,GroupesRepository $grRepo)
    {
        $trouve=true;
        $grp=$grRepo->find($idg);
        
       
       
        if ($this->isGranted('ROLE_ADMIN') && $grp != null ) {
            $app= $grp->getApprenants();
               if($app!= null ) {

                   for ($i=0; $i <count($app) ; $i++) { 
                       if($app[$i]->getId()==$id){
                           $grp->removeApprenant($app[$i]);
                           $em->flush();
                           return $this->json('Apprenant supprimé dans le groupe  ',Response::HTTP_OK);
                       }
                       
                       if($i==count($app)-1 ) {
                        return $this->json('cet apprenant n exste pas  dans ce groupe  ',Response::HTTP_OK);
                       }
                    }

               }
               else{
                return $this->json('Ce groupe n a pas d apprenant ',Response::HTTP_OK);
            }
            
            return $this->json('deleted',Response::HTTP_OK); 
        }
        return $this->json("access denied or not user !!!");
    }

}
