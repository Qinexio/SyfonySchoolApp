<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestQuestionAnswerRepository")
 */
class TestQuestionAnswer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $testQuestionAnswerText;

    /**
     * @ORM\Column(type="boolean")
     */
    private $testQuestionAnswerIsCorrect;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTestQuestionAnswerText(): ?string
    {
        return $this->testQuestionAnswerText;
    }

    public function setTestQuestionAnswerText(string $testQuestionAnswerText): self
    {
        $this->testQuestionAnswerText = $testQuestionAnswerText;

        return $this;
    }

    public function getTestQuestionAnswerIsCorrect(): ?bool
    {
        return $this->testQuestionAnswerIsCorrect;
    }

    public function setTestQuestionAnswerIsCorrect(bool $testQuestionAnswerIsCorrect): self
    {
        $this->testQuestionAnswerIsCorrect = $testQuestionAnswerIsCorrect;

        return $this;
    }
}
