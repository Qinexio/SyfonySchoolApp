<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ScoreRepository")
 */
class Score
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $scoreValue;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScoreValue(): ?int
    {
        return $this->scoreValue;
    }

    public function setScoreValue(int $scoreValue): self
    {
        $this->scoreValue = $scoreValue;

        return $this;
    }
}
