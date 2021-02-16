<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\NiveauRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
 */
class Niveau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"comp"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "entrez le libelle")
     *  @Groups({"comp"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message= "entrez les critères d'evaluation")
     * @Groups({"comp"})
     */
    private $critere_evaluation;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message= "entrer le Groupe d'actions à réaliser")
     * @Groups({"comp"})
     */
    private $groupe_actions;

    /**
     * @ORM\ManyToOne(targetEntity=Competence::class, inversedBy="niveaux")
     */
    private $competence;

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


    public function getCritereEvaluation(): ?string
    {
        return $this->critere_evaluation;
    }

    public function setCritereEvaluation(string $critere_evaluation): self
    {
        $this->critere_evaluation = $critere_evaluation;

        return $this;
    }

    public function getGroupeActions(): ?string
    {
        return $this->groupe_actions;
    }

    public function setGroupeActions(string $groupe_actions): self
    {
        $this->groupe_actions = $groupe_actions;

        return $this;
    }

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }
}
