<?php

namespace App\Entity;

use App\Repository\OrderRecapRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRecapRepository::class)]
class OrderRecap
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $date;

    #[ORM\Column(type: 'integer')]
    private $amount;

    #[ORM\Column(type: 'string', length: 255)]
    private $paimentMethod;

    #[ORM\Column(type: 'string', length: 255)]
    private $facturationAdress;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAmount(): ?int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPaimentMethod(): ?string
    {
        return $this->paimentMethod;
    }

    public function setPaimentMethod(string $paimentMethod): self
    {
        $this->paimentMethod = $paimentMethod;

        return $this;
    }

    public function getFacturationAdress(): ?string
    {
        return $this->facturationAdress;
    }

    public function setFacturationAdress(string $facturationAdress): self
    {
        $this->facturationAdress = $facturationAdress;

        return $this;
    }
}
