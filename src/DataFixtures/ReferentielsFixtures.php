<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Tags;
use App\Entity\Niveau;
use App\Entity\Competence;
use App\Entity\GroupeTags;
use App\Entity\GroupeCompetences;
use App\Entity\Referentiels;
use App\Repository\ProfilRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Repository\GroupeCompetencesRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ReferentielsFixtures extends Fixture

{

    private $grpCom;

    public function __construct(GroupeCompetencesRepository $grpCom)
    {
        $this->grpCom = $grpCom;
        
    } 
    public function load(ObjectManager $manager)
    {

    // à partir de là on va commencer les fixtures pour referentiel 
      
      for ($i=0; $i < 2; $i++) { 
        $referentiels= new Referentiels();
        $referentiels->setLibelle("Referentiel".$i)
                     ->setPresentation("Presentation ".$i)
                    ->setProgramme("programme".$i)
                    ->setEvaluation("Evaluation".$i)
                    ->setAdmission("admission".$i);   
            $grpCompetence= $this->grpCom->findAll();
            $referentiels->addGroupeCompetence($grpCompetence[$i]);
          
        $manager->persist($grpCompetence[$i]);
        $manager->persist($referentiels);
       
      }
      $manager->flush();
     // fin de la fixture Referentiel
   
     
     
} // fin de la fonction load 
}