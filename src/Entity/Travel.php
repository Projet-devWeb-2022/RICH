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

    #[ORM\Column(type: 'date')]
    private $dateDeparture;

    #[ORM\Column(type: 'time')]
    private $departureTime;

    #[ORM\Column(type: 'string', length: 255)]
    private $airportArrival;

    #[ORM\Column(type: 'time')]
    private $arrivalTime;

    #[ORM\Column(type: 'date')]
    private $dateArrival;

    #[ORM\ManyToOne(targetEntity: Vehicle::class, inversedBy: 'travel')]
    #[ORM\JoinColumn(nullable: false)]
    private $vehicle;

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

    public function getDateDeparture(): ?\DateTimeInterface
    {
        return $this->dateDeparture;
    }

    public function setDateDeparture(\DateTimeInterface $dateDeparture): self
    {
        $this->dateDeparture = $dateDeparture;

        return $this;
    }

    public function getDepartureTime(): ?\DateTimeInterface
    {
        return $this->departureTime;
    }

    public function setDepartureTime(\DateTimeInterface $departureTime): self
    {
        $this->departureTime = $departureTime;

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

    public function getArrivalTime(): ?\DateTimeInterface
    {
        return $this->arrivalTime;
    }

    public function setArrivalTime(\DateTimeInterface $arrivalTime): self
    {
        $this->arrivalTime = $arrivalTime;

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

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(?Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }
}
