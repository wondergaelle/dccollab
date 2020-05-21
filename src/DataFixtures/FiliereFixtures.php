<?php

namespace App\DataFixtures;

use App\Entity\Filiere;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FiliereFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $filiere1 = new Filiere();
        $filiere1->setNom("Bachelor Chef de Projet Web");
        $filiere1->setAnnee(new \ DateTime('2020'));

        $manager->persist($filiere1);
        $this->addReference("filiere-1", $filiere1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            EcoleFixtures::class,

        ];
    }
}
