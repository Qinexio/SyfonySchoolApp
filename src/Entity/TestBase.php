<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TestQuestion", mappedBy="testRelation", orphanRemoval=true)
     */
    private $testQuestions;

    public function __construct()
    {
        $this->testQuestions = new ArrayCollection();
    }

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

    /**
     * @return Collection|TestQuestion[]
     */
    public function getTestQuestions(): Collection
    {
        return $this->testQuestions;
    }

    public function addTestQuestion(TestQuestion $testQuestion): self
    {
        if (!$this->testQuestions->contains($testQuestion)) {
            $this->testQuestions[] = $testQuestion;
            $testQuestion->setTestRelation($this);
        }

        return $this;
    }

    public function removeTestQuestion(TestQuestion $testQuestion): self
    {
        if ($this->testQuestions->contains($testQuestion)) {
            $this->testQuestions->removeElement($testQuestion);
            // set the owning side to null (unless already changed)
            if ($testQuestion->getTestRelation() === $this) {
                $testQuestion->setTestRelation(null);
            }
        }

        return $this;
    }
}
