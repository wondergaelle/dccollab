<?php

namespace App\Entity;

use App\Repository\EcoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EcoleRepository::class)
 */
class Ecole
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="ecole")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=Filiere::class, mappedBy="ecoles")
     */
    private $filieres;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->filieres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setEcole($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getEcole() === $this) {
                $user->setEcole(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Filiere[]
     */
    public function getFilieres(): Collection
    {
        return $this->filieres;
    }

    public function addFiliere(Filiere $filiere): self
    {
        if (!$this->filieres->contains($filiere)) {
            $this->filieres[] = $filiere;
            $filiere->addEcole($this);
        }

        return $this;
    }

    public function removeFiliere(Filiere $filiere): self
    {
        if ($this->filieres->contains($filiere)) {
            $this->filieres->removeElement($filiere);
            $filiere->removeEcole($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
