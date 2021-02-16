<?php

namespace App\Entity;

use App\Repository\ProfilSortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 * 
 * collectionOperations={
 *      "get_profils_sortie"={
 *          "method"= "GET",
 *          "path" = "/admin/profilsorties",
 *          "normalization_context"={"groups"={"profil_sortie:read"}},
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *      },
 * 
 *      "create_profils_sortie"={
 *          "method"= "POST",
 *          "path" = "/admin/profilsorties",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))",
 *      }
 * },
 * 
 * itemOperations={
 * 
 *  "get_apprenants_promo_profils_sortie"={
 *          "method"= "GET",
 *          "route_name" = "apprenants_promo_profils_sortie",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *      },
 *  
 *      "get_one_profils_sortie"={
 *          "normalization_context"={"groups"={"p_sortie_apprenant"}},
 *          "method"= "GET",
 *          "path" = "/admin/profilsorties/{id}",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *      },
 * 
 *      "edit_profils_sortie"={
 *          "method"= "PUT",
 *          "path" = "/admin/profilsortie/{id}",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))",
 *      },
 * 
 *   "apprenant_promo_psortie"={    
 *          "method"= "GET",
 *          "route_name" = "apprenant_promo_ps",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *      },
 * 
 * }
 * )
 * @ApiFilter(SearchFilter::class, properties={ "archivage": "exact"})
 * @ORM\Entity(repositoryClass=ProfilSortieRepository::class)
 */
class ProfilSortie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profil_sortie:read","p_sortie_apprenant"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message= "le libelle ne peut pas etre nul")
     * @Groups({"profil_sortie:read","p_sortie_apprenant","p_sortie_apprenant","app_ps_promo"})
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="profilSortie")
     * @Groups({"p_sortie_apprenant"})
     */
    private $apprenants;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $archivage;

    public function __construct()
    {
        $this->apprenants = new ArrayCollection();
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
            $apprenant->setProfilSortie($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        if ($this->apprenants->removeElement($apprenant)) {
            // set the owning side to null (unless already changed)
            if ($apprenant->getProfilSortie() === $this) {
                $apprenant->setProfilSortie(null);
            }
        }

        return $this;
    }

    public function getArchivage(): ?int
    {
        return $this->archivage;
    }

    public function setArchivage(?int $archivage): self
    {
        $this->archivage = $archivage;

        return $this;
    }
}
