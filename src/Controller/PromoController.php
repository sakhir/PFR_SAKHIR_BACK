<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PromoController extends AbstractController
{
    public function getInfoPrincipal()
    {
       dd("ok");
       
    }

     //mdifier la promotion et le referentiel
     public function editPromo(Request $request,$id)
     {
         
        //  $json = json_decode($request->getContent());
        //  //get le promo a editer
        //  $promos = $this->promos->find($id);
        //  if ($promos) {
        //     $promos->setLangue($json->langue);
        //     $promos->setTitre($json->titre);
        //  }
        //  //get referentiels by id
        //  $referentiels = $this->ref->find($json->referentiels->id);
        //  if ($referentiels) {
        //      $referentiels->setLibelle($json->referentiels->libelle);
        //  }
        //  //mise a jour de la base de données
        //  $this->em->flush();
        //  return $this->json("updated successfully");
     }
 
}
