<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserPasswordRepository")
 */
class UserPassword
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
    private $userPassHash;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $userPassSalt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\UserBase", mappedBy="userPassword", cascade={"persist", "remove"})
     */
    private $userRelation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserPassHash(): ?string
    {
        return $this->userPassHash;
    }

    public function setUserPassHash(string $userPassHash): self
    {
        $this->userPassHash = $userPassHash;

        return $this;
    }

    public function getUserPassSalt(): ?string
    {
        return $this->userPassSalt;
    }

    public function setUserPassSalt(string $userPassSalt): self
    {
        $this->userPassSalt = $userPassSalt;

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
        if ($userRelation->getUserPassword() !== $this) {
            $userRelation->setUserPassword($this);
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
