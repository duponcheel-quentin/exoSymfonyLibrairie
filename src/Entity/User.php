<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $userName;

    /**
     * @ORM\Column(type="integer")
     */
    private $userKey;

    /**

     * @ORM\OneToMany(targetEntity="App\Entity\Livres", mappedBy="emprunteur")
     */
    private $livres;



    public function __construct()
    {
        $this->livres = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $librarian;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Library", inversedBy="users")
     */
    private $city;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getUserKey(): ?int
    {
        return $this->userKey;
    }

    public function setUserKey(int $userKey): self
    {
        $this->userKey = $userKey;

        return $this;
    }


    /**
     * @return Collection|Livres[]
     */
    public function getLivres(): Collection
    {
        return $this->livres;
    }

    public function addLivre(Livres $livre): self
    {
        if (!$this->livres->contains($livre)) {
            $this->livres[] = $livre;
            $livre->setEmprunteur($this);
        }
    }

    public function getLibrarian(): ?string
    {
        return $this->librarian;
    }

    public function setLibrarian(string $librarian): self
    {
        $this->librarian = $librarian;

        return $this;
    }

    public function removeLivre(Livres $livre): self
    {
        if ($this->livres->contains($livre)) {
            $this->livres->removeElement($livre);
            // set the owning side to null (unless already changed)
            if ($livre->getEmprunteur() === $this) {
                $livre->setEmprunteur(null);
            }
        }

        return $this;
    }


    public function getCity(): ?Library
    {
        return $this->city;
    }

    public function setCity(?Library $city): self
    {
        $this->city = $city;

        return $this;
    }

}
