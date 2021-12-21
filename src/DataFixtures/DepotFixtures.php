<?php

namespace App\DataFixtures;

use App\Entity\Depot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepotFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $depot = (new Depot())
            ->setTitle('Depot 1')
        ;

        $manager->persist($depot);
        $manager->flush();
    }
}
