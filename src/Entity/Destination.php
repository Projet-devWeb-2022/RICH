<?php

namespace App\Entity;

use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $city;

    #[ORM\Column(type: 'string', length: 1000, nullable: true)]
    private $details;

    #[ORM\ManyToOne(targetEntity: Pays::class)]
    private $pays;

    #[ORM\ManyToOne(targetEntity: Country::class, inversedBy: 'destinations')]
    #[ORM\JoinColumn(nullable: false)]
    private $contry;

    #[ORM\OneToMany(mappedBy: 'destination', targetEntity: Pack::class)]
    private $packs;

    public function __construct()
    {
        $this->packs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getPays(): ?Pays
    {
        return $this->pays;
    }

    public function setPays(?Pays $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getContry(): ?Country
    {
        return $this->contry;
    }

    public function setContry(?Country $contry): self
    {
        $this->contry = $contry;

        return $this;
    }

    /**
     * @return Collection|Pack[]
     */
    public function getPacks(): Collection
    {
        return $this->packs;
    }

    public function addPack(Pack $pack): self
    {
        if (!$this->packs->contains($pack)) {
            $this->packs[] = $pack;
            $pack->setDestination($this);
        }

        return $this;
    }

    public function removePack(Pack $pack): self
    {
        if ($this->packs->removeElement($pack)) {
            // set the owning side to null (unless already changed)
            if ($pack->getDestination() === $this) {
                $pack->setDestination(null);
            }
        }

        return $this;
    }
}
