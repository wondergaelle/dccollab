<?php

namespace App\DataFixtures;

use App\Entity\Projet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class ProjetFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $projet1 = new Projet();
        $projet1->setNom("Projet 1");
        $projet1->setDateCreation(new \ DateTime('01/02/2020'));
        $projet1->setNomEntreprise("entreprise 1");
        $projet1->addCompetence($this->getReference("comp-1"));
        $projet1->setUser($this->getReference("user-admin"));
        $manager->persist($projet1);
        $this->addReference("projet-1",$projet1);

        $manager->flush($projet1);
        }

public function getDependencies()
{
    return[
        UserFixtures::class,
        CompetenceFixtures::class


    ];
}
}
