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
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BeerUser", mappedBy="user_id")
     */
    private $beerUsers;

    public function __construct()
    {
        $this->beerUsers = new ArrayCollection();
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
     * @return Collection|BeerUser[]
     */
    public function getBeerUsers(): Collection
    {
        return $this->beerUsers;
    }

    public function addBeerUser(BeerUser $beerUser): self
    {
        if (!$this->beerUsers->contains($beerUser)) {
            $this->beerUsers[] = $beerUser;
            $beerUser->setUserId($this);
        }

        return $this;
    }

    public function removeBeerUser(BeerUser $beerUser): self
    {
        if ($this->beerUsers->contains($beerUser)) {
            $this->beerUsers->removeElement($beerUser);
            // set the owning side to null (unless already changed)
            if ($beerUser->getUserId() === $this) {
                $beerUser->setUserId(null);
            }
        }

        return $this;
    }
}
