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

    #[ORM\Column(type: 'string', length: 255)]
    private $TransactionType;

    #[ORM\OneToOne(inversedBy: 'orderRecap', targetEntity: orders::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $orderRattached;

    #[ORM\Column(type: 'string', length: 255)]
    private $billingAdress;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTransactionType(): ?string
    {
        return $this->TransactionType;
    }

    public function setTransactionType(string $TransactionType): self
    {
        $this->TransactionType = $TransactionType;

        return $this;
    }

    public function getOrdersRattached(): ?orders
    {
        return $this->orderRattached;
    }

    public function setOrdersRattached(orders $orderRattached): self
    {
        $this->orderRattached = $orderRattached;

        return $this;
    }

    public function getBillingAdress(): ?string
    {
        return $this->billingAdress;
    }

    public function setBillingAdress(string $billingAdress): self
    {
        $this->billingAdress = $billingAdress;

        return $this;
    }
}
