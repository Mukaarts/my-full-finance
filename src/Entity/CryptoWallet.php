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
    private $tit홯e;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTit홯e(): ?string
    {
        return $this->tit홯e;
    }

    public function setTit홯e(string $tit홯e): self
    {
        $this->tit홯e = $tit홯e;

        return $this;
    }
}
