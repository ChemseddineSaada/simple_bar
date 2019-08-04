<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client
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
    private $email;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=1, nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\beer", mappedBy="clientNew")
     */
    private $beer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\categorie", mappedBy="client")
     */
    private $categorie;


    public function __construct()
    {
        $this->beer = new ArrayCollection();
        $this->categorie = new ArrayCollection();
    }

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

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight): self
    {
        $this->weight = $weight;

        return $this;
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
     * @return Collection|beer[]
     */
    public function getBeer(): Collection
    {
        return $this->beer;
    }

    public function addBeer(beer $beer): self
    {
        if (!$this->beer->contains($beer)) {
            $this->beer[] = $beer;
            $beer->setClientNew($this);
        }

        return $this;
    }

    public function removeBeer(beer $beer): self
    {
        if ($this->beer->contains($beer)) {
            $this->beer->removeElement($beer);
            // set the owning side to null (unless already changed)
            if ($beer->getClientNew() === $this) {
                $beer->setClientNew(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|categorie[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
            $categorie->setClient($this);
        }

        return $this;
    }

    public function removeCategorie(categorie $categorie): self
    {
        if ($this->categorie->contains($categorie)) {
            $this->categorie->removeElement($categorie);
            // set the owning side to null (unless already changed)
            if ($categorie->getClient() === $this) {
                $categorie->setClient(null);
            }
        }

        return $this;
    }
   
}
