<?php

namespace App\Entity;

use App\Repository\PackRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackRepository::class)]
class Pack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomPack;

    #[ORM\Column(type: 'integer')]
    private $nbJour;

    #[ORM\Column(type: 'float')]
    private $Prix;

    #[ORM\OneToOne(targetEntity: Destination::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $destination;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $descritpion;

    #[ORM\Column(type: 'integer')]
    private $nbPersonneMax;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPack(): ?string
    {
        return $this->nomPack;
    }

    public function setNomPack(string $nomPack): self
    {
        $this->nomPack = $nomPack;

        return $this;
    }

    public function getNbJour(): ?int
    {
        return $this->nbJour;
    }

    public function setNbJour(int $nbJour): self
    {
        $this->nbJour = $nbJour;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(Destination $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getDescritpion(): ?string
    {
        return $this->descritpion;
    }

    public function setDescritpion(?string $descritpion): self
    {
        $this->descritpion = $descritpion;

        return $this;
    }

    public function getNbPersonneMax(): ?int
    {
        return $this->nbPersonneMax;
    }

    public function setNbPersonneMax(int $nbPersonneMax): self
    {
        $this->nbPersonneMax = $nbPersonneMax;

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
}
