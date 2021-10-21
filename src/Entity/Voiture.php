<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 */
class Voiture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $model;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $km;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $numbersOwners;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $engineSize;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $powerEngine;

    /**
     * @ORM\Column(type="string", length=35)
     */
    private $fuel;

    /**
     * @ORM\Column(type="date")
     */
    private $yearOfEntry;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $transmission;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $options;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="voiture", orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity=Mark::class, inversedBy="voiture")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mark;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coverImage;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getKm(): ?string
    {
        return $this->km;
    }

    public function setKm(string $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getNumbersOwners(): ?int
    {
        return $this->numbersOwners;
    }

    public function setNumbersOwners(int $numbersOwners): self
    {
        $this->numbersOwners = $numbersOwners;

        return $this;
    }

    public function getEngineSize(): ?string
    {
        return $this->engineSize;
    }

    public function setEngineSize(string $engineSize): self
    {
        $this->engineSize = $engineSize;

        return $this;
    }

    public function getPowerEngine(): ?string
    {
        return $this->powerEngine;
    }

    public function setPowerEngine(string $powerEngine): self
    {
        $this->powerEngine = $powerEngine;

        return $this;
    }

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): self
    {
        $this->fuel = $fuel;

        return $this;
    }

    public function getYearOfEntry(): ?\DateTimeInterface
    {
        return $this->yearOfEntry;
    }

    public function setYearOfEntry(\DateTimeInterface $yearOfEntry): self
    {
        $this->yearOfEntry = $yearOfEntry;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(string $options): self
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setVoiture($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getVoiture() === $this) {
                $image->setVoiture(null);
            }
        }

        return $this;
    }

    public function getMark(): ?Mark
    {
        return $this->mark;
    }

    public function setMark(?Mark $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(string $coverImage): self
    {
        $this->coverImage = $coverImage;

        return $this;
    }
}
