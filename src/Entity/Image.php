<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameImg;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voiture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $caption;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameImg(): ?string
    {
        return $this->nameImg;
    }

    public function setNameImg(string $nameImg): self
    {
        $this->nameImg = $nameImg;

        return $this;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(?string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }
}
