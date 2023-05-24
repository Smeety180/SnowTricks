<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;




#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomDeFichier = null;


    #[ORM\ManyToOne(targetEntity: Figure::class, inversedBy: 'images', cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Figure $figure = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDeFichier(): ?string
    {
        return $this->nomDeFichier;
    }

    public function setNomDeFichier(string $nomDeFichier): self
    {
        $this->nomDeFichier = $nomDeFichier;

        return $this;
    }

    public function getFigure(): ?Figure
    {
        return $this->figure;
    }

    public function setFigure(?Figure $figure): self
    {
        $this->figure = $figure;

        return $this;
    }
}
