<?php

namespace App\DataFixtures;

use App\Entity\Wallet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class WalletFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $wallet = (new Wallet())->setTitle('bcee')->setCategory(0);
        $manager->persist($wallet);

        $wallet = (new Wallet())->setTitle('bcee')->setCategory(1);
        $manager->persist($wallet);

        $manager->flush();
    }
}
