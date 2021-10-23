<?php

namespace App\Entity;

use App\Repository\MarkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MarkRepository::class)
 */
class Mark
{
   

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $nameMark;

    /**
     * @ORM\OneToMany(targetEntity=Voiture::class, mappedBy="mark", orphanRemoval=true)
     */
    private $voiture;

    public function __construct()
    {
        $this->voiture = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameMark(): ?string
    {
        return $this->nameMark;
    }

    public function setNameMark(string $nameMark): self
    {
        $this->nameMark = $nameMark;

        return $this;
    }

    /**
     * @return Collection|Voiture[]
     */
    public function getVoiture(): Collection
    {
        return $this->voiture;
    }

    public function addVoiture(Voiture $voiture): self
    {
        if (!$this->voiture->contains($voiture)) {
            $this->voiture[] = $voiture;
            $voiture->setMark($this);
        }

        return $this;
    }

    //ajout method toString pour afficher mes marques
    public function __toString()
    {
        return (string) $this -> getNameMark();
    }
    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->voiture->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getMark() === $this) {
                $voiture->setMark(null);
            }
        }

        return $this;
    }
}
