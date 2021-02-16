<?php

namespace App\Controller;

use App\Repository\ApprenantRepository;
use App\Repository\PromosRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilSortieController extends AbstractController
{
    private $promosRepo;
    private $apprenantRepo;
    public function __construct(PromosRepository $promosRepo,ApprenantRepository $apprenantRepo)
    {
        $this->promosRepo = $promosRepo;
        $this->apprenantRepo = $apprenantRepo;
    }
    
    public function getApprenantPromoProfilSortie($id)
    {
       $promos = $this->promosRepo->find($id);
       if ($promos) {
           return $this->json($promos,Response::HTTP_OK,[],["groups"=> "profil_sortie:read"]);
       }
    }

    public function getApprenantDunProfilDunePromo($idpromo,$id)
    {
        $app = array();
        $apprenants = $this->apprenantRepo->findAll();
        foreach ($apprenants as $student) {
            //testons s'il ya un ou des apprenant(s) dans la promo qui a ce profil de sortie 
            if ($this->apprenantRepo->ifApprenantInPromo($idpromo,$student->getId(),$id)) {
               $app[] = $student;
            }
        } 

        if ($app) {
           return $this->json($app,Response::HTTP_OK,[],["groups"=>"app_ps_promo"]);
        }else{
            return $this->json("pas d'apprenant dans ce promo qui a ce profil de sortie");
        }
    }
}
