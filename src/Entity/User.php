<?php

namespace App\Entity;

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

    public function getLibrarian(): ?string
    {
        return $this->librarian;
    }

    public function setLibrarian(string $librarian): self
    {
        $this->librarian = $librarian;

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
