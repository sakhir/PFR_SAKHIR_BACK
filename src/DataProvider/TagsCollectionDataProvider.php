<?php

namespace App\DataProvider;
use App\Entity\Tags;

use App\Entity\BlogPost;
use App\Entity\Competence;
use App\Entity\GroupeTags;
use App\Entity\GroupeCompetences;
use App\Repository\TagsRepository;
use App\Repository\CompetenceRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;

final class TagsCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface


{
    private $tagRePo;
    public function __construct(TagsRepository $tagRepo)
    
    {
        $this->tagRePo = $tagRepo;
    } 

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Tags::class === $resourceClass ;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        // Retrieve the blog post collection from somewhere
    
             
        return $this->tagRePo->findBy(['archivage'=>0]); 
       
    }
}