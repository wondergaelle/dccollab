<?php

namespace App\DataFixtures;

use App\Entity\Ecole;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EcoleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $ecole1 = new Ecole();
        $ecole1->setNom("DC-Rennes");
        $ecole1->setVille("Rennes");
        $manager->persist($ecole1);
        $this->addReference("ecole-1", $ecole1);
        $manager->flush();
    }
}
