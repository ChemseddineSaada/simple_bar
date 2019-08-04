<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class categorie
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
    private $title;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\beer")
     */
    private $category_beer;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $term;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Beer", mappedBy="categorie")
     */
    private $beers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="categorie")
     */
    private $client;



    public function __construct()
    {
        $this->category_beer = new ArrayCollection();
        $this->beers = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->clients_list = new ArrayCollection();
    }

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

    /**
     * @return Collection|beer[]
     */
    public function getCategoryBeer(): Collection
    {
        return $this->category_beer;
    }

    public function addCategoryBeer(beer $categoryBeer): self
    {
        if (!$this->category_beer->contains($categoryBeer)) {
            $this->category_beer[] = $categoryBeer;
        }

        return $this;
    }

    public function removeCategoryBeer(beer $categoryBeer): self
    {
        if ($this->category_beer->contains($categoryBeer)) {
            $this->category_beer->removeElement($categoryBeer);
        }

        return $this;
    }

    public function getTerm(): ?string
    {
        return $this->term;
    }

    public function setTerm(string $term): self
    {
        $this->term = $term;

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
            $beer->addCategorie($this);
        }

        return $this;
    }

    public function removeBeer(Beer $beer): self
    {
        if ($this->beers->contains($beer)) {
            $this->beers->removeElement($beer);
            $beer->removeCategorie($this);
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    } 
}