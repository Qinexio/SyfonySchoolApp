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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserBase", inversedBy="userScores")
     * @ORM\JoinColumn(nullable=false)
     */
    private $scoreUser;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TestBase", inversedBy="testScores")
     * @ORM\JoinColumn(nullable=false)
     */
    private $scoreTest;

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

    public function getScoreUser(): ?UserBase
    {
        return $this->scoreUser;
    }

    public function setScoreUser(?UserBase $scoreUser): self
    {
        $this->scoreUser = $scoreUser;

        return $this;
    }

    public function getScoreTest(): ?TestBase
    {
        return $this->scoreTest;
    }

    public function setScoreTest(?TestBase $scoreTest): self
    {
        $this->scoreTest = $scoreTest;

        return $this;
    }
}
