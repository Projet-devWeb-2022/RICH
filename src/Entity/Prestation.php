<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PrestationRepository::class)]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name:"prestationType", type:"string")]
#[ORM\DiscriminatorMap(["prestation" => Prestation::class, "hotels" => Hotel::class, "travel" => Travel::class, "vehicleRental" => VehicleRental::class,"activity" => Activity::class])]

class Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'boolean')]
    private $isAvailable;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 1000)]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $nbPersonMax;

    #[ORM\Column(type: 'blob', nullable: true)]
    private $image;

    #[ORM\ManyToMany(targetEntity: Destination::class, inversedBy: 'prestations')]
    private $destination;

    public function __construct()
    {
        $this->destination = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIsAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): self
    {
        $this->isAvailable = $isAvailable;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNbPersonMax(): ?int
    {
        return $this->nbPersonMax;
    }

    public function setNbPersonMax(int $nbPersonMax): self
    {
        $this->nbPersonMax = $nbPersonMax;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Destination[]
     */
    public function getDestination(): Collection
    {
        return $this->destination;
    }

    public function addDestination(Destination $destination): self
    {
        if (!$this->destination->contains($destination)) {
            $this->destination[] = $destination;
        }

        return $this;
    }

    public function removeDestination(Destination $destination): self
    {
        $this->destination->removeElement($destination);

        return $this;
    }
}
