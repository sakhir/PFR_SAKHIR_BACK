<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\GroupeCompetencesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=GroupeCompetencesRepository::class)
 *  @ApiResource(
 * 
 * collectionOperations={
 *      "create_grpe_competences"={
 *           "route_name" = "create_groupe_competence",
 *           "security" = "is_granted('ROLE_ADMIN')",
 *          "security_message"= "seul l'admin a accès a cette resource"
 *      },
 * 
 *      "get_grp_c"={
 *          "normalization_context"={"groups"={"all_grp_c"}},
 *          "method"= "GET",
 *          "path" = "/admin/grpecompetences/competences",
 *          "security" = "is_granted('ROLE_ADMIN')",
 *          "security_message"= "seul l'admin a accès a cette resource"
 *      },
 * 
 *      "liste_grpe_competences"={
 *          "normalization_context"={"groups"={"grpecompetence:read"}},
 *          "method"= "GET",
 *          "path" = "admin/grpecompetences",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *          "security_message"= "vous n'avez pas accès"
 *      },
 * },
 * 
 * itemOperations={
 * 
 *      "get_one_grpe_competences"={
 *          "normalization_context"={"groups"={"grpecompetence:read"}},
 *          "method"= "GET",
 *          "path" = "admin/grpecompetences/{id}",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *          "security_message"= "vous n'avez pas accès"
 *      },
 * 
 *      "edit_grpe_competences"={
 *          "normalization_context"={"groups"={"grpecompetence:read"}},
 *          "route_name" ="edit_grpe_competences",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *      },
 * 
 *      "competences_get_subresource"= {
 *               "normalization_context"={"groups"={"competence_grp"}},
 *               "method"= "GET",
 *               "path" = "/admin/grpecompetences/{id}/competences",
 *                "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *                "security_message"= "vous n'avez pas accès"
 *          }
 * }
 * )
 */
class GroupeCompetences
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer") 
     * @Groups({"comp","grpecompetence:read","all_grp_c","competence_grp","referentiels":"read","grpe_and_competences:read","grpe_and_competences:write","ref:read","referentiels":"write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "le libelle ne peut pas etre vide")
     * @Groups({"comp","grpecompetence:read","all_grp_c","competence_grp","referentiels":"read","grpe_and_competences:read","grpe_and_competences:write","ref:read","referentiels":"write"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     * @Groups({"comp","grpecompetence:read"})
     * @Assert\NotBlank(message= "entrer une description")
     * @Groups({"grpecompetence:read","all_grp_c","grpe_and_competences:read","grpe_and_competences:write","ref:read","referentiels":"write"})
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class, mappedBy="competences",cascade={"persist"})
     * @Groups({"all_grp_c","competence_grp","ref:read","referentiels":"write"})
     * @Assert\Valid
     * @Assert\NotBlank(message="veuillez affecter au moins une competence pour ce groupe")
     * @ApiSubresource 
     */
    private $competences;

    /**
     * @ORM\ManyToMany(targetEntity=Referentiels::class, inversedBy="groupeCompetences",cascade={"persist"})
     */
    private $referentiels;

    /**
     * @ORM\Column(type="integer",nullable=true)
     * @Groups({"referentiels":"write"})
     */
    private $archivage;

   
   

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->referentiels = new ArrayCollection();
        $this->groupeCompetences = new ArrayCollection();
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
     * @return Collection|Competence[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->addCompetence($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            $competence->removeCompetence($this);
        }

        return $this;
    }

    /**
     * @return Collection|Referentiels[]
     */
    public function getReferentiels(): Collection
    {
        return $this->referentiels;
    }

    public function addReferentiel(Referentiels $referentiel): self
    {
        if (!$this->referentiels->contains($referentiel)) {
            $this->referentiels[] = $referentiel;
        }

        return $this;
    }

    public function removeReferentiel(Referentiels $referentiel): self
    {
        $this->referentiels->removeElement($referentiel);

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
