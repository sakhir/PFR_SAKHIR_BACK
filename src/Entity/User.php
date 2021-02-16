<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource(
 * attributes={
 *      "pagination_enabled"=true,
 *      "security" = "is_granted('ROLE_ADMIN')",
 *      "security_message" = "vous n'avez pas accès a cette resource"
 *   },
 * collectionOperations={
 * 
 * "get_users"={
 *          "method"= "GET",
 *          "path" = "/admin/users",
 *          "normalization_context"={"groups"={"user:read"}}    
 *    },
 * 
 * 
 * "create_users"={
 *          "method"= "POST",
 *          "path" = "/admin/users",
 *          "route_name"="create_user",
 *   },
 * },
 * itemOperations={
 *      "get_one_user"={
 *             "method"="GET",
 *             "path" = "/admin/users/{id}",
 *              "normalization_context"={"groups"={"user:read"}},
 *      },
 *      "edit_user"={
 *             "method"="POST",
 *             "path" = "/admin/users/{id}",
 *             "route_name"="edit_user",
 *      },
 * },
 * 
 * 
 * )

* @ORM\InheritanceType("SINGLE_TABLE")
* @ORM\DiscriminatorColumn(name = "type", type = "string")
* @ORM\DiscriminatorMap({"formateur"="Formateur","CM"="CM", "apprenant"="Apprenant","test"="Test" ,"admin"="User"})
* @ApiFilter(SearchFilter::class, properties={"isdeleted": "exact"})
* @ApiFilter(OrderFilter::class, properties={"prenom"})
* 
*/
class User implements UserInterface 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"profil:read","user:read","grp:read","apprenants:read","grp:write","promo:read","user:dl"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"profil:read","user:read","grp:read","apprenants:read","grp:write","user:dl"})
      
     */
    private $email;

    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","grp:read","apprenants:read","grp:write","promo:read","user:dl"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","grp:read","apprenants:read","grp:write","promo:read","user:dl"})
     */
    private $nom;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $isdeleted;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @Groups({"user:read","user:dl"})
     */
    private $avatar;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $isconnect;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"user:read","user:dl"})
     */
    private $profil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_'.$this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getIsdeleted(): ?int
    {
        return $this->isdeleted;
    }

    public function setIsdeleted(int $isdeleted): self
    {
        $this->isdeleted = $isdeleted;

        return $this;
    }

    public function getAvatar()
    {
       
            $av=@stream_get_contents($this->avatar);
           
            @fclose($av);
            return base64_encode($av);
        
        
        
    }

    public function setAvatar($avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getIsconnect(): ?int
    {
        return $this->isconnect;
    }

    public function setIsconnect(int $isconnect): self
    {
        $this->isconnect = $isconnect;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    // "get_users"={
    //     *          "method"= "GET",
    //     *          "path" = "/admin/users",
    //     *          "normalization_context"={"groups"={"user:read"}}
    //     *   }

    // "get_users_actif"={
    //     *          "route_name"="All_users_actif"
    //     *   },
}
