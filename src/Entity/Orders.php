<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
#[ORM\Table(name: '`orders`')]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: pack::class)]
    private $pack;

    #[ORM\Column(type: 'datetime')]
    private $dateOfOrder;

    #[ORM\ManyToMany(targetEntity: Prestation::class)]
    private $prestation;

    #[ORM\Column(type: 'float')]
    private $ammount;

    #[ORM\OneToOne(mappedBy: 'orderRattached', targetEntity: OrderRecap::class, cascade: ['persist', 'remove'])]
    private $orderRecap;

    public function __construct()
    {
        $this->prestation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPack(): ?pack
    {
        return $this->pack;
    }

    public function setPack(?pack $pack): self
    {
        $this->pack = $pack;

        return $this;
    }

    public function getDateOfOrder(): ?\DateTimeInterface
    {
        return $this->dateOfOrder;
    }

    public function setDateOfOrder(\DateTimeInterface $dateOfOrder): self
    {
        $this->dateOfOrder = $dateOfOrder;

        return $this;
    }

    /**
     * @return Collection|Prestation[]
     */
    public function getPrestation(): Collection
    {
        return $this->prestation;
    }

    public function addPrestation(Prestation $prestation): self
    {
        if (!$this->prestation->contains($prestation)) {
            $this->prestation[] = $prestation;
        }

        return $this;
    }

    public function removePrestation(Prestation $prestation): self
    {
        $this->prestation->removeElement($prestation);

        return $this;
    }

    public function getAmmount(): ?float
    {
        return $this->ammount;
    }

    public function setAmmount(float $ammount): self
    {
        $this->ammount = $ammount;

        return $this;
    }

    public function getOrderRecap(): ?OrderRecap
    {
        return $this->orderRecap;
    }

    public function setOrderRecap(OrderRecap $orderRecap): self
    {
        // set the owning side of the relation if necessary
        if ($orderRecap->getOrderRattached() !== $this) {
            $orderRecap->setOrderRattached($this);
        }

        $this->orderRecap = $orderRecap;

        return $this;
    }
}
