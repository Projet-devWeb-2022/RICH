<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'integer')]
    private $nbPeopleMax;

    #[ORM\Column(type: 'integer')]
    private $priceDay;

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

    public function getNbPeopleMax(): ?int
    {
        return $this->nbPeopleMax;
    }

    public function setNbPeopleMax(int $nbPeopleMax): self
    {
        $this->nbPeopleMax = $nbPeopleMax;

        return $this;
    }

    public function getPriceDay(): ?int
    {
        return $this->priceDay;
    }

    public function setPriceDay(int $priceDay): self
    {
        $this->priceDay = $priceDay;

        return $this;
    }
}
