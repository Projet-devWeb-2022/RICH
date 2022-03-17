<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity extends Prestation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string')]
    private $typeActivity;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date;

    #[ORM\Column(type: 'string', length: 255)]
    private $adressActivity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeActivity(): ?\DateTimeInterface
    {
        return $this->typeActivity;
    }

    public function setTypeActivity(String $typeActivity): self
    {
        $this->typeActivity = $typeActivity;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAdressActivity(): ?string
    {
        return $this->adressActivity;
    }

    public function setAdressActivity(string $adressActivity): self
    {
        $this->adressActivity = $adressActivity;

        return $this;
    }
}
