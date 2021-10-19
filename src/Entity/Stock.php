<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\StockRepository;

/**
 * @ORM\Entity(repositoryClass=StockRepository::class)
 */
class Stock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $ticker;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="stock", cascade={"persist"})
     */
    private $transactions;

    /**
     * @ORM\OneToMany(targetEntity=Dividend::class, mappedBy="stock", cascade={"persist"}))
     */
    private $dividends;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
        $this->dividends = new ArrayCollection();
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

    public function getTicker(): ?string
    {
        return $this->ticker;
    }

    public function setTicker(string $ticker): self
    {
        $this->ticker = $ticker;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setStock($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getStock() === $this) {
                $transaction->setStock(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Dividend[]
     */
    public function getDividends(): Collection
    {
        return $this->dividends;
    }

    public function addDividend(Dividend $dividend): self
    {
        if (!$this->dividends->contains($dividend)) {
            $this->dividends[] = $dividend;
            $dividend->setStock($this);
        }

        return $this;
    }

    public function removeDividend(Dividend $dividend): self
    {
        if ($this->dividends->removeElement($dividend)) {
            // set the owning side to null (unless already changed)
            if ($dividend->getStock() === $this) {
                $dividend->setStock(null);
            }
        }

        return $this;
    }

}
