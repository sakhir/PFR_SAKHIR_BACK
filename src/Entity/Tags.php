<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TagsRepository::class)
 *  @ApiResource(
 *attributes={
 *      "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))",
 *      "security_message" = "vous n'avez pas accès a cette resource"
 *   },
 * collectionOperations={
 *      "get_tags"={
 *          "normalization_context"={"groups"={"tags:read"}},
 *          "method" = "GET",
 *          "path" = "/admin/tags"
 *      },
 * 
 *      "create_tags"={
 *          "method" = "POST",
 *          "path" = "/admin/tags"
 *      }
 * },
 * 
 * itemOperations={
 * 
 *      "get_one_tags"={
 *          "normalization_context"={"groups"={"tags:read"}},
 *          "method" = "GET",
 *          "path" = "/admin/tags/{id}"
 *      },
 * 
 *      "edit_tags"={
 *          "method" = "PUT",
 *          "path" = "/admin/tags/{id}"
 *      },
 *  "delete_tag"={
 *             "method"="DELETE",
 *             "path" = "/admin/tags/{id}",
 *      },
 * }
 * )
 */
class Tags
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"tags:read","grpeTags:write","grpeTags:read","grpTag:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "le libelle ne peut pas etre vide")
     *  @Groups({"tags:read","grpeTags:read","grpeTags:write","grpTag:write"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "entrer une description pour ce tag")
     * @Groups({"tags:read","grpeTags:read","grpeTags:write","grpTag:write"})
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeTags::class, mappedBy="tags",cascade={"persist"})
     * @Assert\NotBlank(message= "ce tag doit avoir au moins un groupe de Tag")
     * @Groups({"tags:read"})
     */
    private $groupeTags;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"grpeTags:write","grpTag:write"})
     */
    private $archivage;

    public function __construct()
    {
        $this->groupeTags = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|GroupeTags[]
     */
    public function getGroupeTags(): Collection
    {
        return $this->groupeTags;
    }

    public function addGroupeTag(GroupeTags $groupeTag): self
    {
        if (!$this->groupeTags->contains($groupeTag)) {
            $this->groupeTags[] = $groupeTag;
            $groupeTag->addTag($this);
        }

        return $this;
    }

    public function removeGroupeTag(GroupeTags $groupeTag): self
    {
        if ($this->groupeTags->removeElement($groupeTag)) {
            $groupeTag->removeTag($this);
        }

        return $this;
    }

    public function getArchivage(): ?int
    {
        return $this->archivage;
    }

    public function setArchivage(int $archivage): self
    {
        $this->archivage = $archivage;

        return $this;
    }
}
