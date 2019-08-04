<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 * 
 */
class Country
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\beer", inversedBy="country_id")
     */
    private $beer_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Beer", mappedBy="countryId")
     */
    private $beers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Beer", mappedBy="country_id")
     */
    private $beersNew;

    public function __construct()
    {
        $this->beers = new ArrayCollection();
        $this->beersNew = new ArrayCollection();
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBeerId(): ?beer
    {
        return $this->beer_id;
    }

    public function setBeerId(?beer $beer_id): self
    {
        $this->beer_id = $beer_id;

        return $this;
    }

    /**
     * @return Collection|Beer[]
     */
    public function getBeers(): Collection
    {
        return $this->beers;
    }

    public function addBeer(Beer $beer): self
    {
        if (!$this->beers->contains($beer)) {
            $this->beers[] = $beer;
            $beer->setCountryId($this);
        }

        return $this;
    }

    public function removeBeer(Beer $beer): self
    {
        if ($this->beers->contains($beer)) {
            $this->beers->removeElement($beer);
            // set the owning side to null (unless already changed)
            if ($beer->getCountryId() === $this) {
                $beer->setCountryId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Beer[]
     */
    public function getBeersNew(): Collection
    {
        return $this->beersNew;
    }

    public function addBeersNew(Beer $beersNew): self
    {
        if (!$this->beersNew->contains($beersNew)) {
            $this->beersNew[] = $beersNew;
            $beersNew->setCountryId($this);
        }

        return $this;
    }

    public function removeBeersNew(Beer $beersNew): self
    {
        if ($this->beersNew->contains($beersNew)) {
            $this->beersNew->removeElement($beersNew);
            // set the owning side to null (unless already changed)
            if ($beersNew->getCountryId() === $this) {
                $beersNew->setCountryId(null);
            }
        }

        return $this;
    }
}
