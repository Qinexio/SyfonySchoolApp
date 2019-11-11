<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TestAnswer", mappedBy="testQuestion", orphanRemoval=true)
     */
    private $testAnswers;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TestBase", inversedBy="testQuestions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $testRelation;

    public function __construct()
    {
        $this->testAnswers = new ArrayCollection();
    }

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

    /**
     * @return Collection|TestAnswer[]
     */
    public function getTestAnswers(): Collection
    {
        return $this->testAnswers;
    }

    public function addTestAnswer(TestAnswer $testAnswer): self
    {
        if (!$this->testAnswers->contains($testAnswer)) {
            $this->testAnswers[] = $testAnswer;
            $testAnswer->setTestQuestion($this);
        }

        return $this;
    }

    public function removeTestAnswer(TestAnswer $testAnswer): self
    {
        if ($this->testAnswers->contains($testAnswer)) {
            $this->testAnswers->removeElement($testAnswer);
            // set the owning side to null (unless already changed)
            if ($testAnswer->getTestQuestion() === $this) {
                $testAnswer->setTestQuestion(null);
            }
        }

        return $this;
    }

    public function getTestRelation(): ?TestBase
    {
        return $this->testRelation;
    }

    public function setTestRelation(?TestBase $testRelation): self
    {
        $this->testRelation = $testRelation;

        return $this;
    }
	
	public function __toString(){
        // to show the name of the entity in the select
        //return $this->entfield;
        // to show the id of the entity in the select
       return strval($this->id);
    }
}
