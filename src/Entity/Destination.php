<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 65)]
    private $ville;

    #[ORM\Column(type: 'string', length: 65)]
    private $pays;

    #[ORM\Column(type: 'string', length: 55, nullable: true)]
    private $continentPays;

    #[ORM\Column(type: 'string', length: 255)]
    private $details;

    #[ORM\Column(type: 'integer')]
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getContinentPays(): ?string
    {
        return $this->continentPays;
    }

    public function setContinentPays(?string $continentPays): self
    {
        $this->continentPays = $continentPays;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDetails(): ?String
    {
        return $this->details;
    }

    public function setDetails(String $details): self
    {
        $this->details = $details;

        return $this;
    }
}
