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
    private $PickingAddress;

    #[ORM\Column(type: 'datetime')]
    private $pickUpDate;

    #[ORM\Column(type: 'datetime')]
    private $dropOffDate;

    #[ORM\ManyToOne(targetEntity: Vehicle::class, inversedBy: 'vehicleRentals')]
    #[ORM\JoinColumn(nullable: false)]
    private $vehicle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPickingAddress(): ?string
    {
        return $this->PickingAddress;
    }

    public function setPickingAddress(string $PickingAddress): self
    {
        $this->PickingAddress = $PickingAddress;

        return $this;
    }

    public function getPickUpDate(): ?\DateTimeInterface
    {
        return $this->pickUpDate;
    }

    public function setPickUpDate(\DateTimeInterface $pickUpDate): self
    {
        $this->pickUpDate = $pickUpDate;

        return $this;
    }

    public function getDropOffDate(): ?\DateTimeInterface
    {
        return $this->dropOffDate;
    }

    public function setDropOffDate(\DateTimeInterface $dropOffDate): self
    {
        $this->dropOffDate = $dropOffDate;

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
