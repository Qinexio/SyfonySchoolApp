<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestBaseRepository")
 */
class TestBase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $testName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $testDescription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTestName(): ?string
    {
        return $this->testName;
    }

    public function setTestName(string $testName): self
    {
        $this->testName = $testName;

        return $this;
    }

    public function getTestDescription(): ?string
    {
        return $this->testDescription;
    }

    public function setTestDescription(string $testDescription): self
    {
        $this->testDescription = $testDescription;

        return $this;
    }
}
