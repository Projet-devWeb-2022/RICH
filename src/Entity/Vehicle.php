<?php

namespace App\Entity;

use App\Repository\VehicleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehicleRepository::class)]
class Vehicle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\Column(type: 'float')]
    private $PriceDay;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: Travel::class)]
    private $travel;

    #[ORM\OneToMany(mappedBy: 'vehicle', targetEntity: VehicleRental::class)]
    private $vehicleRentals;

    public function __construct()
    {
        $this->travel = new ArrayCollection();
        $this->vehicleRentals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPriceDay(): ?float
    {
        return $this->PriceDay;
    }

    public function setPriceDay(float $PriceDay): self
    {
        $this->PriceDay = $PriceDay;

        return $this;
    }

    /**
     * @return Collection|Travel[]
     */
    public function getTravel(): Collection
    {
        return $this->travel;
    }

    public function addTravel(Travel $travel): self
    {
        if (!$this->travel->contains($travel)) {
            $this->travel[] = $travel;
            $travel->setVehicle($this);
        }

        return $this;
    }

    public function removeTravel(Travel $travel): self
    {
        if ($this->travel->removeElement($travel)) {
            // set the owning side to null (unless already changed)
            if ($travel->getVehicle() === $this) {
                $travel->setVehicle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VehicleRental[]
     */
    public function getVehicleRentals(): Collection
    {
        return $this->vehicleRentals;
    }

    public function addVehicleRental(VehicleRental $vehicleRental): self
    {
        if (!$this->vehicleRentals->contains($vehicleRental)) {
            $this->vehicleRentals[] = $vehicleRental;
            $vehicleRental->setVehicle($this);
        }

        return $this;
    }

    public function removeVehicleRental(VehicleRental $vehicleRental): self
    {
        if ($this->vehicleRentals->removeElement($vehicleRental)) {
            // set the owning side to null (unless already changed)
            if ($vehicleRental->getVehicle() === $this) {
                $vehicleRental->setVehicle(null);
            }
        }

        return $this;
    }
}
