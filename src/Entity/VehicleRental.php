<?php

namespace App\Entity;

use App\Repository\VehicleRentalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRentalRepository::class)]
class VehicleRental extends Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $typeVehicul;

    #[ORM\Column(type: 'date', nullable: true)]
    private $pickUpDate;

    #[ORM\Column(type: 'date', nullable: true)]
    private $dropOffDate;

    #[ORM\Column(type: 'string', length: 255)]
    private $pickUpLocation;

    #[ORM\OneToOne(targetEntity: Vehicle::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $vehicle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeVehicul(): ?string
    {
        return $this->typeVehicul;
    }

    public function setTypeVehicul(string $typeVehicul): self
    {
        $this->typeVehicul = $typeVehicul;

        return $this;
    }

    public function getPickUpDate(): ?\DateTimeInterface
    {
        return $this->pickUpDate;
    }

    public function setPickUpDate(?\DateTimeInterface $pickUpDate): self
    {
        $this->pickUpDate = $pickUpDate;

        return $this;
    }

    public function getDropOffDate(): ?\DateTimeInterface
    {
        return $this->dropOffDate;
    }

    public function setDropOffDate(?\DateTimeInterface $dropOffDate): self
    {
        $this->dropOffDate = $dropOffDate;

        return $this;
    }

    public function getPickUpLocation(): ?string
    {
        return $this->pickUpLocation;
    }

    public function setPickUpLocation(string $pickUpLocation): self
    {
        $this->pickUpLocation = $pickUpLocation;

        return $this;
    }

    public function getVehicle(): ?Vehicle
    {
        return $this->vehicle;
    }

    public function setVehicle(Vehicle $vehicle): self
    {
        $this->vehicle = $vehicle;

        return $this;
    }
}
