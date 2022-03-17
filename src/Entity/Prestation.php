<?php

namespace App\Entity;

use App\Repository\PrestationRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Type;


#[ORM\Entity(repositoryClass: PrestationRepository::class)]
#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name:"prestationType", type:"string")]
#[ORM\DiscriminatorMap(["prestation" => Prestation::class, "stays" => Stays::class, "travel" => Travel::class, "vehicleRental" => VehicleRental::class,"activity" => Activity::class])]

class Prestation
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $label;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\Column(type: 'boolean')]
    private $isAvailable;

    #[ORM\Column(type: 'json', nullable: true)]
    private $img = [];

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $nbPeopleMax;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
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

    public function getImg(): ?array
    {
        return $this->img;
    }

    public function setImg(?array $img): self
    {
        $this->img = $img;

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

    public function getNbPeopleMax(): ?int
    {
        return $this->nbPeopleMax;
    }

    public function setNbPeopleMax(int $nbPeopleMax): self
    {
        $this->nbPeopleMax = $nbPeopleMax;

        return $this;
    }
}
