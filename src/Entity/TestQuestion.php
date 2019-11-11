<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestQuestionRepository")
 */
class TestQuestion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $testQuestionText;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTestQuestionText(): ?string
    {
        return $this->testQuestionText;
    }

    public function setTestQuestionText(string $testQuestionText): self
    {
        $this->testQuestionText = $testQuestionText;

        return $this;
    }
}
