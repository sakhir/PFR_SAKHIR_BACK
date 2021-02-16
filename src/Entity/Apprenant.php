<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ApprenantRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 * @ApiResource(
 * collectionOperations={
 *    "get_apprenant"={
 *           "route_name"="list_apprenant",
 *          "normalization_context"={"groups"={"user:read"}},
 *   },
 * },
 * )
 */
class Apprenant extends User
{
    

      /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"apprenants:read","grp:write"})
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"grp:read","apprenants:read","grp:write"})
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"grp:read","apprenants:read","grp:write"})
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"grp:read","apprenants:read","grp:write"})
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"grp:read","apprenants:read","grp:write"})
     */
    private $statut;

    /**
     * @ORM\ManyToMany(targetEntity=Groupes::class, mappedBy="apprenants",cascade={"persist"})
     */
    private $groupes;

    /**
     * @ORM\ManyToOne(targetEntity=Promos::class, inversedBy="apprenants")
     */
    private $promos;

    /**
     * @ORM\ManyToOne(targetEntity=ProfilSortie::class, inversedBy="apprenants")
     */
    private $profilSortie;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->statut="actif";
    }

    public function getId(): ?int
    {
        return $this->id;
    }  

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|Groupes[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupes $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addApprenant($this);
        }

        return $this;
    }

    public function removeGroupe(Groupes $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            $groupe->removeApprenant($this);
        }

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

    public function getProfilSortie(): ?ProfilSortie
    {
        return $this->profilSortie;
    }

    public function setProfilSortie(?ProfilSortie $profilSortie): self
    {
        $this->profilSortie = $profilSortie;

        return $this;
    }
}
