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

    public function __construct()
    {
        $this->userRole = new ArrayCollection();
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
}
