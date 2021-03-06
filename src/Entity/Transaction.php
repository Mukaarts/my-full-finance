<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
#[ORM\Table(name: "`transaction`")]
class Transaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "integer")]
    private $orderType;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private $amount;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private $price;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private $fee;

    #[ORM\Column(type: 'datetime')]
    private $dateAt;

    #[ORM\ManyToOne(targetEntity: Stock::class, inversedBy: "transactions")]
    #[ORM\JoinColumn(nullable: false)]
    private $stock;

    #[ORM\ManyToOne(targetEntity: Wallet::class, inversedBy: "transactions")]
    private $wallet;

    #[ORM\ManyToOne(targetEntity: Depot::class, inversedBy: "transactions")]
    private $depot;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderType(): ?int
    {
        return $this->orderType;
    }

    public function setOrderType(int $orderType): self
    {
        $this->orderType = $orderType;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFee(): ?string
    {
        return $this->fee;
    }

    public function setFee(string $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    public function getDateAt(): ?\DateTimeInterface
    {
        return $this->dateAt;
    }

    public function setDateAt(\DateTimeInterface $dateAt): self
    {
        $this->dateAt = $dateAt;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getWallet(): ?Wallet
    {
        return $this->wallet;
    }

    public function setWallet(?Wallet $wallet): self
    {
        $this->wallet = $wallet;

        return $this;
    }

    public function __toString()
    {
        return $this->dateAt->format('Y-m-d');
    }

    public function getDepot(): ?Depot
    {
        return $this->depot;
    }

    public function setDepot(?Depot $depot): self
    {
        $this->depot = $depot;

        return $this;
    }

    public function getFullPrice(): ?string
    {
        return $this->amount * $this->price;
    }

}
