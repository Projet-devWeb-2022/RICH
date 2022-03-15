<?php

namespace App\Entity;

use App\Repository\StaysRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StaysRepository::class)]

class Stays extends Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $typeOfStay;

    #[ORM\Column(type: 'date')]
    private $CheckIn;

    #[ORM\Column(type: 'date')]
    private $checkOut;

    #[ORM\Column(type: 'string', length: 255)]
    private $adress;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOfStay(): ?string
    {
        return $this->typeOfStay;
    }

    public function setTypeOfStay(string $typeOfStay): self
    {
        $this->typeOfStay = $typeOfStay;

        return $this;
    }

    public function getCheckIn(): ?\DateTimeInterface
    {
        return $this->CheckIn;
    }

    public function setCheckIn(\DateTimeInterface $CheckIn): self
    {
        $this->CheckIn = $CheckIn;

        return $this;
    }

    public function getCheckOut(): ?\DateTimeInterface
    {
        return $this->checkOut;
    }

    public function setCheckOut(\DateTimeInterface $checkOut): self
    {
        $this->checkOut = $checkOut;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->adress;
    }

    public function setAdress(string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }
}
