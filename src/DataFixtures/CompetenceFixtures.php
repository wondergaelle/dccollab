<?php

namespace App\DataFixtures;

use App\Entity\Competence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CompetenceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $comp1 = new Competence();
        $comp1->setNom("PHP");
        $comp1->addUser($this->getReference("user-admin"));
        $comp1->setCategorie($this->getReference("cat-dev"));
        $comp1->addProjet($this->getReference("projet-1"));
        $manager->persist($comp1);
        $this->addReference("comp1", $comp1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            CategorieFixtures::class,
            ProjetFixtures::class
        ];
    }
}
