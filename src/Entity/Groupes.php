<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupesRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * 
 * @ApiResource(
 * 
 * collectionOperations={
 * 
 *      "get_admin_groupes"={
 *          "normalization_context"={"groups"={"grp:read"}},
 *          "method"= "GET",
 *          "path"= "/admin/groupes",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *          
 *      },
 * 
 *     "get_admin_groupes_apprenants"={
 *          "method"= "GET",
 *           "normalization_context"={"groups"={"apprenants:read"}},
 *          "path"= "/admin/groupes/apprenants",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') )"
 *          
 *      },
 * 
 *     "Create_groupes_apprennant_formateur"={
 *          "denormalization_context"={"groups"={"grp:write"}},
 *          "method"= "POST",
 *          "path"= "/admin/groupes",
 *          "security" = "(is_granted('ROLE_ADMIN') )"
 *          
 *      }
 * },
 * 
 * itemOperations={
 * 
 *      "get_admin_groupes_id"={
 *          "method"= "GET",
 *          "path"= "/admin/groupes/{id}",
 *          "security" = "(is_granted('ROLE_ADMIN') )"
 *      },
 * 
 *      "Ajouter_apprenant_groupe"={
 *          "method"= "PUT",
 *          "path"= "/admin/groupes/{id}",
 *          "security" = "(is_granted('ROLE_ADMIN') )"
 *      },
 *  "delete_app_grp"={
 *          "route_name"="delete_app_grp",
 *          "security" = "(is_granted('ROLE_ADMIN') )"
 *      }
 * }
 * )
 * @ORM\Entity(repositoryClass=GroupesRepository::class)
 */
class Groupes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"apprenants:read","grp:write","promo:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"grp:read","apprenants:read","grp:write","promo:read"})
     * @Assert\NotBlank(message= "entrer le nom du groupe")
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(message= "entrer la date de creation")
     * @Groups({"grp:read","apprenants:read","grp:write"})
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "saisir le statut")
     * @Groups({"grp:read","apprenants:read","grp:write"})
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "saisir le type")
     * @Groups({"grp:read","apprenants:read","grp:write","promo:read"})
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=Apprenant::class, inversedBy="groupes",cascade={"persist"})
     * @Groups({"grp:read","apprenants:read","grp:write"})
     * @ApiSubresource

     */
    private $apprenants;

    /**
     * @ORM\ManyToMany(targetEntity=Formateur::class, inversedBy="groupes",cascade={"persist"})
     * @Groups({"grp:read","grp:write"})
     */
    private $formateurs;

    /**
     * @ORM\ManyToOne(targetEntity=Promos::class, inversedBy="groupes")
     */
    private $promos;

    public function __construct()
    {
        $this->apprenants = new ArrayCollection();
        $this->formateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Apprenant[]
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(Apprenant $apprenant): self
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants[] = $apprenant;
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        $this->apprenants->removeElement($apprenant);

        return $this;
    }

    /**
     * @return Collection|Formateur[]
     */
    public function getFormateurs(): Collection
    {
        return $this->formateurs;
    }

    public function addFormateur(Formateur $formateur): self
    {
        if (!$this->formateurs->contains($formateur)) {
            $this->formateurs[] = $formateur;
        }

        return $this;
    }

    public function removeFormateur(Formateur $formateur): self
    {
        $this->formateurs->removeElement($formateur);

        return $this;
    }

    public function getPromos(): ?Promos
    {
        return $this->promos;
    }

    public function setPromos(?Promos $promos): self
    {
        $this->promos = $promos;

        return $this;
    }
}
