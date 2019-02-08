<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 */
class Categories
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Livres", mappedBy="categories")
     */
    private $Livres;

    public function __construct()
    {
        $this->Livres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Livres[]
     */
    public function getLivres(): Collection
    {
        return $this->Livres;
    }

    public function addLivre(Livres $livre): self
    {
        if (!$this->Livres->contains($livre)) {
            $this->Livres[] = $livre;
            $livre->setCategories($this);
        }

        return $this;
    }

    public function removeLivre(Livres $livre): self
    {
        if ($this->Livres->contains($livre)) {
            $this->Livres->removeElement($livre);
            // set the owning side to null (unless already changed)
            if ($livre->getCategories() === $this) {
                $livre->setCategories(null);
            }
        }

        return $this;
    }
}
