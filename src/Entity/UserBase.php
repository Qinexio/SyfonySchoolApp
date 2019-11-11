<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserBaseRepository")
 */
class UserBase
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
    private $userName;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserDetail", inversedBy="userRelation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $userDetail;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserPassword", inversedBy="userRelation", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $userPassword;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\UserRole", inversedBy="userRelation")
     */
    private $userRole;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Score", mappedBy="scoreUser", orphanRemoval=true)
     */
    private $userScores;

    public function __construct()
    {
        $this->userRole = new ArrayCollection();
        $this->userScores = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    public function getUserDetail(): ?userDetail
    {
        return $this->userDetail;
    }

    public function setUserDetail(userDetail $userDetail): self
    {
        $this->userDetail = $userDetail;

        return $this;
    }

    public function getUserPassword(): ?userPassword
    {
        return $this->userPassword;
    }

    public function setUserPassword(userPassword $userPassword): self
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * @return Collection|UserRole[]
     */
    public function getUserRole(): Collection
    {
        return $this->userRole;
    }

    public function addUserRole(UserRole $userRole): self
    {
        if (!$this->userRole->contains($userRole)) {
            $this->userRole[] = $userRole;
        }

        return $this;
    }

    public function removeUserRole(UserRole $userRole): self
    {
        if ($this->userRole->contains($userRole)) {
            $this->userRole->removeElement($userRole);
        }

        return $this;
    }

    /**
     * @return Collection|Score[]
     */
    public function getUserScores(): Collection
    {
        return $this->userScores;
    }

    public function addUserScore(Score $userScore): self
    {
        if (!$this->userScores->contains($userScore)) {
            $this->userScores[] = $userScore;
            $userScore->setScoreUser($this);
        }

        return $this;
    }

    public function removeUserScore(Score $userScore): self
    {
        if ($this->userScores->contains($userScore)) {
            $this->userScores->removeElement($userScore);
            // set the owning side to null (unless already changed)
            if ($userScore->getScoreUser() === $this) {
                $userScore->setScoreUser(null);
            }
        }

        return $this;
    }
}
