<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BeerRepository")
 */
class beer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\Column(type="string", length=100)
    * @Assert\NotBlank(
    * message="Title can't be empty !"
    * )
    */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $published_at;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     * @Assert\NotNull(
     * message="Price can't be null !"
     * )
     */
    private $Price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", inversedBy="beersNew", cascade={"persist"})
     */
    private $country_id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\categorie", inversedBy="beers")
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="beer")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="beer")
     */
    private $beer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="beer")
     */
    private $clientNew;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=1, nullable=true)
     */
    private $degree;

    const NOTE_GOOD = 'good';
    const NOTE_VERY_GOOD = 'very good';
    const NOTE_BAD = 'bad';
    const NOTE_NOT_GOOD = 'not good';

    /**
    * @ORM\Column(type="string", length=100, nullable=true)
    */
    private $note;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\BeerUser", mappedBy="beer_id")
     */
    private $beerUsers;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->beerUsers = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->published_at;
    }

    public function setPublishedAt(?\DateTimeInterface $published_at): self
    {
        $this->published_at = $published_at;

        return $this;
    }
    

    public function getPrice()
    {
        return $this->Price;
    }

    public function setPrice($Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getCountryId(): ?Country
    {
        return $this->country_id;
    }

    public function setCountryId(?Country $country_id): self
    {
        $this->country_id = $country_id;

        return $this;
    }

    /**
     * @return Collection|categorie[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
            // associer les bières au catégorie
            $categorie->addBeer($this);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): self
    {
        if ($this->categorie->contains($categorie)) {
            $this->categorie->removeElement($categorie);
        }

        return $this;
    }

    public function getClientNew(): ?Client
    {
        return $this->clientNew;
    }

    public function setClientNew(?Client $clientNew): self
    {
        $this->clientNew = $clientNew;

        return $this;
    }

    public function getDegree()
    {
        return $this->degree;
    }

    public function setDegree($degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        if (!in_array($note, [
            self::NOTE_BAD, self::NOTE_GOOD,
            self::NOTE_NOT_GOOD,
            self::NOTE_VERY_GOOD])){
            throw new \InvalidArgumentException("Invalid note");
    }
        $this->note = $note;
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
            $beerUser->setBeerId($this);
        }

        return $this;
    }

    public function removeBeerUser(BeerUser $beerUser): self
    {
        if ($this->beerUsers->contains($beerUser)) {
            $this->beerUsers->removeElement($beerUser);
            // set the owning side to null (unless already changed)
            if ($beerUser->getBeerId() === $this) {
                $beerUser->setBeerId(null);
            }
        }

        return $this;
    }

}
