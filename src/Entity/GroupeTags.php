<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeTagsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=GroupeTagsRepository::class)
 * @ApiResource(
 * 
 * attributes={
 *      "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))",
 *      "security_message" = "vous n'avez pas accès a cette resource"
 *   },
 * 
 * subresourceOperations={
 *     "tags_get_subresource"={
 *          "method" = "GET",
 *          "path"  = "/admin/grptags/{id}/tags"
 *      },
 * 
 * },
 *  collectionOperations={
 *      "get_grpe_tags"={
 *          "normalization_context"={"groups"={"grpeTags:read"}},
 *          "method" = "GET",
 *          "path" = "/admin/grptags"
 *  },
 * 
 *  "create_grpe_tags"={
 *          "normalization_context"={"groups"={"grpeTags:read"}},
 *          "denormalization_context"={"groups"={"grpeTags:write"}},
 *          "method" = "POST",
 *          "path" = "/admin/grptags"
 *   }
 * },
 * 
 * itemOperations={
 *      "get_one_grpe_tags"={
 *          "normalization_context"={"groups"={"grpeTags:read"}},
 *          "method" = "GET",
 *          "path"  = "/admin/grptags/{id}/tags"
 *      },
 *      "get_one_grpe"={
 *          "normalization_context"={"groups"={"grpeTagsrek"}},
 *          "method" = "GET",
 *          "path"  = "/admin/grptags/{id}"
 *      },
 * 
 *      "edit_tags"={
 *          "method" = "PUT",
 *          "path"  = "/admin/grptags/{id}",
 *          "denormalization_context"={"groups"={"grpTag:write"}}
 *      }
 * }
 * )
 */
class GroupeTags
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"tags:read","grpeTags:read","grpeTags:write","grpeTagsrek","grpTag:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "le libelle ne peut pas etre vide")
     * @Groups({"tags:read","grpeTags:read" ,"grpeTags:write","grpeTagsrek","grpTag:write"})
     */
    private $libelle;

    /**
     * @ORM\ManyToMany(targetEntity=Tags::class, inversedBy="groupeTags",cascade={"persist"})
     * @Assert\Count(min=1,minMessage="On doit avoir au moins un Tag dans le groupe") 
     * @Groups({"grpeTags:write","grpTag:write","grpeTags:read"})
     * @ApiSubresource
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Tags[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        $this->tags->removeElement($tag);

        return $this;
    }
}
