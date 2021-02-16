<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Tags;
use App\Entity\User;
use App\Entity\Profil;
use App\Entity\Promos;
use App\Entity\Groupes;
use App\Entity\Apprenant;
use App\Entity\Formateur;
use App\Entity\Competence;
use App\Entity\GroupeTags;
use App\Entity\ProfilSortie;
use App\Entity\Referentiels;
use App\Entity\GroupeCompetences;
use App\Repository\UserRepository;
use App\DataFixtures\ProfilFixtures;
use App\Repository\ProfilRepository;
use App\Repository\ApprenantRepository;
use Doctrine\Persistence\ObjectManager;
use App\Repository\ReferentielsRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SGroupesFixtures extends Fixture
{
    private $encode;
    private $profils;
    private $referentiels;
    private $apprenants;

    public function __construct(UserPasswordEncoderInterface $encode,ProfilRepository $profils,ReferentielsRepository $ref, UserRepository $app)
    {
        $this->encode = $encode;
        $this->profils = $profils;
        $this->referentiels = $ref;
        $this->apprenants = $app;
    }
    
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

         for ($i=1; $i < 3; $i++) { 
             $grpc = new Groupes;
            $grpc->setNom("Groupe".$i)
             ->setDateCreation(new \DateTime("now"))
            ->setStatut("statut".$i) 
             ->setType("type".$i) ;

            
             for ($j=1; $j < 3; $j++) { 
                 $apprenant = new Apprenant;
                 $password = $this->encode->encodePassword ($apprenant, 'passer' );
                 $apprenant->setTelephone($faker->phoneNumber)
                 ->setTelephone($faker->phoneNumber)
                 ->setAdresse($faker->city)
                 ->setGenre('masculin')
                 ->setStatut('actif')
                 ->setEmail($faker->email)
                 ->setPrenom($faker->firstName())
                 ->setNom($faker->lastName())
                 ->setPassword ($password )
                 ->setProfil($this->profils->find(2))
                ->setIsdeleted(0)
                ->setIsconnect(0)
                ->setAvatar('img')
                
                
                 ;

             $grpc->addApprenant($apprenant);
             }

             for ($j=1; $j < 3; $j++) { 
                 $formateur = new Formateur;
                 $password = $this->encode->encodePassword ($formateur, 'passer' );
                 $formateur
                 ->setEmail($faker->email)
                 ->setPrenom($faker->firstName())
                 ->setNom($faker->lastName())
                 ->setPassword ($password )
                 ->setProfil($this->profils->find(3))
                 ->setIsconnect(0)
                 ->setIsdeleted(0)
                 ->setAvatar('img')
                 ;

             $grpc->addFormateur($formateur);
             }
             $manager->persist($grpc);
     }
        $manager->flush();
    }
public function getDependencies()
{
    return ProfilFixtures::class;
}
}
