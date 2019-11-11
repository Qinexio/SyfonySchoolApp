<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRoleRepository")
 */
class UserRole
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
    private $userPermision;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\UserBase", mappedBy="userRole")
     */
    private $userRelation;

    public function __construct()
    {
        $this->UserRelation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserPermision(): ?string
    {
        return $this->userPermision;
    }

    public function setUserPermision(string $userPermision): self
    {
        $this->userPermision = $userPermision;

        return $this;
    }

    /**
     * @return Collection|UserBase[]
     */
    public function getUserRelation(): Collection
    {
        return $this->UserRelation;
    }

    public function addUserRelation(UserBase $userRelation): self
    {
        if (!$this->UserRelation->contains($userRelation)) {
            $this->UserRelation[] = $userRelation;
            $userRelation->addUserRole($this);
        }

        return $this;
    }

    public function removeUserRelation(UserBase $userRelation): self
    {
        if ($this->UserRelation->contains($userRelation)) {
            $this->UserRelation->removeElement($userRelation);
            $userRelation->removeUserRole($this);
        }

        return $this;
    }
}
