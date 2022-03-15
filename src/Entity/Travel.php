<?php

namespace App\Entity;

use App\Repository\TravelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TravelRepository::class)]
class Travel extends Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $airportDeparture;

    #[ORM\Column(type: 'string', length: 255)]
    private $airportArrival;

    #[ORM\Column(type: 'string', length: 255)]
    private $dateDeparture;

    #[ORM\Column(type: 'date')]
    private $dateArrival;

    #[ORM\OneToOne(targetEntity: Vehicle::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $vehicule;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAirportDeparture(): ?string
    {
        return $this->airportDeparture;
    }

    public function setAirportDeparture(string $airportDeparture): self
    {
        $this->airportDeparture = $airportDeparture;

        return $this;
    }

    public function getAirportArrival(): ?string
    {
        return $this->airportArrival;
    }

    public function setAirportArrival(string $airportArrival): self
    {
        $this->airportArrival = $airportArrival;

        return $this;
    }

    public function getDateDeparture(): ?string
    {
        return $this->dateDeparture;
    }

    public function setDateDeparture(string $dateDeparture): self
    {
        $this->dateDeparture = $dateDeparture;

        return $this;
    }

    public function getDateArrival(): ?\DateTimeInterface
    {
        return $this->dateArrival;
    }

    public function setDateArrival(\DateTimeInterface $dateArrival): self
    {
        $this->dateArrival = $dateArrival;

        return $this;
    }

    public function getVehicule(): ?Vehicle
    {
        return $this->vehicule;
    }

    public function setVehicule(Vehicle $vehicule): self
    {
        $this->vehicule = $vehicule;

        return $this;
    }
}
