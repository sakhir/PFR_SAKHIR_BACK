<?php

namespace App\DataProvider;
use App\Entity\BlogPost;

use App\Entity\Competence;
use App\Entity\GroupeCompetences;
use App\Repository\CompetenceRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

final class GroupeCompetencesCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface


{
    private $compRePo;
    public function __construct(CompetenceRepository $compRepo)
    
    {
        $this->compRePo = $compRepo;
    } 

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Competence::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        // Retrieve the blog post collection from somewhere
        
             
        return $this->compRePo->findBy(['archivage'=>0]); 
       
    }
}