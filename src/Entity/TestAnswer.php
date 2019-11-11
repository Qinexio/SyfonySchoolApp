<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestAnswerRepository")
 */
class TestAnswer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $testAnswerText;

    /**
     * @ORM\Column(type="boolean")
     */
    private $testAnswerIsCorrect;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TestQuestion", inversedBy="testAnswers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $testQuestion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTestAnswerText(): ?string
    {
        return $this->testAnswerText;
    }

    public function setTestAnswerText(string $testAnswerText): self
    {
        $this->testAnswerText = $testAnswerText;

        return $this;
    }

    public function getTestAnswerIsCorrect(): ?bool
    {
        return $this->testAnswerIsCorrect;
    }

    public function setTestAnswerIsCorrect(bool $testAnswerIsCorrect): self
    {
        $this->testAnswerIsCorrect = $testAnswerIsCorrect;

        return $this;
    }

    public function getTestQuestion(): ?TestQuestion
    {
        return $this->testQuestion;
    }

    public function setTestQuestion(?TestQuestion $testQuestion): self
    {
        $this->testQuestion = $testQuestion;

        return $this;
    }
}
