<?php

namespace App\Entity;

use App\Repository\CryptoWalletRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CryptoWalletRepository::class)
 */
class CryptoWallet
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
    private $tit�le;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTit�le(): ?string
    {
        return $this->tit�le;
    }

    public function setTit�le(string $tit�le): self
    {
        $this->tit�le = $tit�le;

        return $this;
    }
}
