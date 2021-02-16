<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReferentielsRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReferentielsRepository::class)
 *  @ApiResource(
 * 
 * collectionOperations={
 *      "get_referentiels_grpecompetences"={
 *          "normalization_context"={"groups"={"referentiels":"read"}},
 *          "method"= "GET",
 *          "path" = "/admin/referentiels",
 *           "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *      },
 * 
 *      "get_grpecompetences_competences"={
 *          "normalization_context"={"groups"={"grpe_and_competences:read"}},
 *          "method"= "GET",
 *          "path" = "/admin/referentiels/grpecompetences",
 *           "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *      },
 * 
 *      "create_referentiels"={
 *          
 *          "denormalization_context"={"groups"={"grpe_and_competences:write"}},
 *          "method"= "POST",
 *          "path" = "/admin/referentiels",
 *           "security" = "is_granted('ROLE_ADMIN')",
 *      }
 * },
 * 
 * itemOperations={
 *      "get_grpecompetences_referentiels"={
 *          "normalization_context"={"groups"={"referentiels":"read"}},
 *          "method"= "GET",
 *          "path" = "/admin/referentiels/{id}",
 *           "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM') or is_granted('ROLE_APPRENANT'))",
 *      },
 * 
 *      "edit_grpecompetences_referentiels"={
 *          "denormalization_context"={"groups"={"referentiels":"write"}},
 *          "method"= "PUT",
 *          "path" = "/admin/referentiels/{id}",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM') or is_granted('ROLE_APPRENANT'))",
 *      },
 * 
*      "competences_groupe_competences_ref"={
*              "method"= "GET",
*              "route_name"= "get_comp_gc_ref",
*              "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM') or is_granted('ROLE_APPRENANT'))",
*          },
 * }
 * )
 */
class Referentiels
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"referentiels":"read","grpe_and_competences:write","ref:read","referentiels":"write","promo:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "entrer le libelle")
     * @Groups({"referentiels":"read","grpe_and_competences:write","ref:read","promo:read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "faites une presentation du referentiel")
     * @Groups({"referentiels":"read","grpe_and_competences:write","ref:read"})
     */
    private $presentation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "rediger un programme pour ce referentiel")
     * @Groups({"referentiels":"read","grpe_and_competences:write"})
     */
    private $programme;

    /**
     * @ORM\Column(type="text")
     * @Groups({"referentiels":"read","grpe_and_competences:write"})
     */
    private $evaluation;

    /**
     * @ORM\Column(type="text")
     * @Groups({"referentiels":"read","grpe_and_competences:write"})
     */
    private $admission;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetences::class, mappedBy="referentiels",cascade={"persist"})
     * @ApiSubresource
     * @Groups({"referentiels":"read","grpe_and_competences:read","grpe_and_competences:write","ref:read","referentiels":"write"})
     */
    private $groupeCompetences;

    /**
     * @ORM\OneToMany(targetEntity=Promos::class, mappedBy="referentiels")
     */
    private $promos;

 

    public function __construct()
    {
        $this->groupeCompetences = new ArrayCollection();
        $this->promos = new ArrayCollection();
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

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getProgramme(): ?string
    {
        return $this->programme;
    }

    public function setProgramme(string $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getEvaluation(): ?string
    {
        return $this->evaluation;
    }

    public function setEvaluation(string $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    public function getAdmission(): ?string
    {
        return $this->admission;
    }

    public function setAdmission(string $admission): self
    {
        $this->admission = $admission;

        return $this;
    }

    /**
     * @return Collection|GroupeCompetences[]
     */
    public function getGroupeCompetences(): Collection
    {
        return $this->groupeCompetences;
    }

    public function addGroupeCompetence(GroupeCompetences $groupeCompetence): self
    {
        if (!$this->groupeCompetences->contains($groupeCompetence)) {
            $this->groupeCompetences[] = $groupeCompetence;
            $groupeCompetence->addReferentiel($this);
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetences $groupeCompetence): self
    {
        if ($this->groupeCompetences->removeElement($groupeCompetence)) {
            $groupeCompetence->removeReferentiel($this);
        }

        return $this;
    }

    /**
     * @return Collection|Promos[]
     */
    public function getPromos(): Collection
    {
        return $this->promos;
    }

    public function addPromo(Promos $promo): self
    {
        if (!$this->promos->contains($promo)) {
            $this->promos[] = $promo;
            $promo->setReferentiels($this);
        }

        return $this;
    }

    public function removePromo(Promos $promo): self
    {
        if ($this->promos->removeElement($promo)) {
            // set the owning side to null (unless already changed)
            if ($promo->getReferentiels() === $this) {
                $promo->setReferentiels(null);
            }
        }

        return $this;
    }


}
