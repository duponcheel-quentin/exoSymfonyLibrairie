<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LivresRepository")
 */
class Livres
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    private $resume;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $edition;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateBorrowing;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateReturn;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="Livres")
     */
    private $categories;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
<<<<<<< HEAD
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="livres")
     */
    private $emprunteur;


=======
     * @ORM\ManyToOne(targetEntity="App\Entity\Library", inversedBy="livres")
     */
    private $city;
>>>>>>> 0941147f88c3a9fcb8c9bd6a20723a0c03051fcf

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getEdition(): ?string
    {
        return $this->edition;
    }

    public function setEdition(string $edition): self
    {
        $this->edition = $edition;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDateBorrowing(): ?\DateTimeInterface
    {
        return $this->dateBorrowing;
    }

    public function setDateBorrowing(\DateTimeInterface $dateBorrowing): self
    {
        $this->dateBorrowing = $dateBorrowing;

        return $this;
    }

    public function getDateReturn(): ?\DateTimeInterface
    {
        return $this->dateReturn;
    }

    public function setDateReturn(\DateTimeInterface $dateReturn): self
    {
        $this->dateReturn = $dateReturn;

        return $this;
    }

    public function getCategories(): ?Categories
    {
        return $this->categories;
    }

    public function setCategories(?Categories $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }


    public function getEmprunteur(): ?User
    {
        return $this->emprunteur;
    }

    public function setEmprunteur(?User $emprunteur): self
    {
        $this->emprunteur = $emprunteur;

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
