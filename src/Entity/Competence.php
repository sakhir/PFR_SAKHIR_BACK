<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CompetenceRepository::class)
 * @ApiResource(
 * collectionOperations={
 *      "get_competences_and_niveaux"={
 *          "method"= "GET",
 *          "path"= "/admin/competences",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *           "normalization_context"={"groups"={"comp"}},
 *          
 *      },
 * 
 *      "create_competences_and_niveaux"={
 *          "path"= "/admin/competences",
 *          "method"= "POST",
 *           "security" = "is_granted('ROLE_ADMIN')",
 *          
 *      }
 * 
 * },
 * 
 * itemOperations={
 * 
 *      "get_levels_competences"={
 *          "method"= "GET",
 *          "path"= "/admin/competences/{id}",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *           "normalization_context"={"groups"={"comp"}},         
 *      },
 *      "edit_levels"={
 *          "method"= "PUT",
 *          "path"= "/admin/competences/{id}",
 *          "security" = "is_granted('ROLE_ADMIN')",
 *           "normalization_context"={"groups"={"comp"}}, 
 *      },
 *      "archivage_competence"={
 *  
 *          "security" = "is_granted('ROLE_ADMIN')",
 *           "normalization_context"={"groups"={"comp"}}, 
 *           "route_name"="archivage_competence",
 *      },
 * 
 * }
 * 
 * )
 */
class Competence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"comp","grpecompetence:read","all_grp_c","competence_grp","ref:read","referentiels":"write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "entrer un libelle pour la competence")
     * @Groups({"comp","grpecompetence:read","all_grp_c","competence_grp","ref:read"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message= "entrer une description pour cette competence")
     * @Groups({"comp","all_grp_c","competence_grp","ref:read"})
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetences::class, inversedBy="competences",cascade={"persist"})
     * @Assert\NotBlank(message="veuillez affecter cette competence a au moins un groupe ")
     * @Groups({"comp"})
     */
    private $competences;

    /**
     * @ORM\OneToMany(targetEntity=Niveau::class, mappedBy="competence",cascade={"persist"})
     * @Groups({"comp"})
     */
    private $niveaux;

    /**
     * @ORM\Column(type="integer")
     */
    private $archivage;


    public function __construct()
    {
        $this->groupeCompetences = new ArrayCollection();
        $this->competences = new ArrayCollection();
        $this->niveaux = new ArrayCollection();
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
     * @return Collection|GroupeCompetences[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(GroupeCompetences $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
        }

        return $this;
    }

    public function removeCompetence(GroupeCompetences $competence): self
    {
        $this->competences->removeElement($competence);

        return $this;
    }

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveaux->contains($niveau)) {
            $this->niveaux[] = $niveau;
            $niveau->setCompetence($this);
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        if ($this->niveaux->removeElement($niveau)) {
            // set the owning side to null (unless already changed)
            if ($niveau->getCompetence() === $this) {
                $niveau->setCompetence(null);
            }
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
