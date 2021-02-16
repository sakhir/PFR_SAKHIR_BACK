<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PromosRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PromosRepository::class)
 * @ApiResource( 
 * )
 */
class Promos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"promo:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message= "choisissez la langue")
     * @Groups({"promo:read"})
     */
    private $langue;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message= "entrer le titre")
     * @Groups({"promo:read"})
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "entrer la description")
     * @Groups({"promo:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lieu;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "la fabrique ne peut pas etre null")
     * @Groups({"promo:read"})
     
     */
    private $fabrique;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message= "entrer la date de debut de la promotion")
     * @Groups({"promo:read"})
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message= "entrer la date de fin provisoire")
     * @Groups({"promo:read"})
     */
    private $dateFinProvisoire;

    /**
     * @ORM\Column(type="date", nullable=true)
     * 
     */
    private $dateFinReel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "donner l'etat de la promotion")
     * @Groups({"promo:read"})
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Referentiels::class, inversedBy="promos")
     * @ApiSubresource
     * @Groups({"promo:read"})
     */
    private $referentiels;

    /**
     * @ORM\ManyToMany(targetEntity=Formateur::class, inversedBy="promos",cascade={"persist"})
     * @Groups({"promo:read"})
     */
    private $formateurs;

    /**
     * @ORM\OneToMany(targetEntity=Groupes::class, mappedBy="promos")
     * @Groups({"promo:read"})
     * @ApiSubresource
     */
    private $groupes;

    /**
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="promos")
     * @ApiSubresource
     */
    private $apprenants;

    public function __construct()
    {
        $this->formateurs = new ArrayCollection();
        $this->groupes = new ArrayCollection();
        $this->apprenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getFabrique(): ?string
    {
        return $this->fabrique;
    }

    public function setFabrique(string $fabrique): self
    {
        $this->fabrique = $fabrique;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFinProvisoire(): ?\DateTimeInterface
    {
        return $this->dateFinProvisoire;
    }

    public function setDateFinProvisoire(\DateTimeInterface $dateFinProvisoire): self
    {
        $this->dateFinProvisoire = $dateFinProvisoire;

        return $this;
    }

    public function getDateFinReel(): ?\DateTimeInterface
    {
        return $this->dateFinReel;
    }

    public function setDateFinReel(?\DateTimeInterface $dateFinReel): self
    {
        $this->dateFinReel = $dateFinReel;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getReferentiels(): ?Referentiels
    {
        return $this->referentiels;
    }

    public function setReferentiels(?Referentiels $referentiels): self
    {
        $this->referentiels = $referentiels;

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
            $groupe->setPromos($this);
        }

        return $this;
    }

    public function removeGroupe(Groupes $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getPromos() === $this) {
                $groupe->setPromos(null);
            }
        }

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
            $apprenant->setPromos($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        if ($this->apprenants->removeElement($apprenant)) {
            // set the owning side to null (unless already changed)
            if ($apprenant->getPromos() === $this) {
                $apprenant->setPromos(null);
            }
        }

        return $this;
    }
}
