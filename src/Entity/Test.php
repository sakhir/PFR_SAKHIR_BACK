<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TestRepository::class)
 */
class Test extends User
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $var;

    public function getVar(): ?string
    {
        return $this->var;
    }

    public function setVar(string $var): self
    {
        $this->var = $var;

        return $this;
    }
}
