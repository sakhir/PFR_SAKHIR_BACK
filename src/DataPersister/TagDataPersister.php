<?php


namespace App\DataPersister;


use App\Entity\Tags;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;

final class TagDataPersister implements ContextAwareDataPersisterInterface
{

    private $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;

    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Tags;
    }

    public function persist($data, array $context = [])
    {
      // call your persistence layer to save $data
      $data->setLibelle($data->getLibelle());
      $data->setDescription($data->getDescription()); 
      $data->setArchivage(0);
       $this->manager->persist($data);
       $this->manager->flush();
 
      // dd($data->getLibelle(),$data->getArchivage());
  
      return $data;

    } 

    public function remove($data, array $context = [])
    {

        
      // call your persistence layer to delete $data
      $data->setArchivage(1);
      $this->manager->flush();
      

    }
}