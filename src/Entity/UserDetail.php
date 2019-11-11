<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserDetailRepository")
 */
class UserDetail
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
    private $userEmail;

    /**
     * @ORM\Column(type="boolean")
     */
    private $userValid;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $userKey;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserBase", mappedBy="userDetail", cascade={"persist", "remove"})
     */
    private $userRelation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserEmail(): ?string
    {
        return $this->userEmail;
    }

    public function setUserEmail(string $userEmail): self
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    public function getUserValid(): ?bool
    {
        return $this->userValid;
    }

    public function setUserValid(bool $userValid): self
    {
        $this->userValid = $userValid;

        return $this;
    }

    public function getUserKey(): ?string
    {
        return $this->userKey;
    }

    public function setUserKey(string $userKey): self
    {
        $this->userKey = $userKey;

        return $this;
    }

    public function getUserRelation(): ?UserBase
    {
        return $this->userRelation;
    }

    public function setUserRelation(UserBase $userRelation): self
    {
        $this->userRelation = $userRelation;

        // set the owning side of the relation if necessary
        if ($userRelation->getUserDetail() !== $this) {
            $userRelation->setUserDetail($this);
        }

        return $this;
    }
	
	public function __toString(){
        // to show the name of the entity in the select
        //return $this->entfield;
        // to show the id of the entity in the select
        return strval($this->id);
    }
}
