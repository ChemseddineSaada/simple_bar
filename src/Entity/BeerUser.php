<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
* @ORM\Entity(repositoryClass="App\Repository\BeerUserRepository")
* @Table(name="beer_user",
* uniqueConstraints={
* @UniqueConstraint(name="user_beer_relation_unique",
* columns={"beer_id_id", "user_id_id", "note", "degree"})
* }
* )
*/
class BeerUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=1, nullable=true)
     */
    private $degree;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="beerUsers")
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\beer", inversedBy="beerUsers")
     */
    private $beer_id;

    const NOTE_GOOD = 'good';
    const NOTE_VERY_GOOD = 'very good';
    const NOTE_BAD = 'bad';
    const NOTE_NOT_GOOD = 'not good';

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDegree()
    {
        return $this->degree;
    }

    public function setDegree($degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

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
}
