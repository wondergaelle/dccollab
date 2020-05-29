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
        $comp1->addUser($this->getReference("user1"));
        $comp1->setCategorie($this->getReference("cat-dev"));
        $comp1->addProjet($this->getReference("projet-1"));
        $comp1->addProjet($this->getReference("projet-2"));
        $manager->persist($comp1);
        $this->addReference("comp-1", $comp1);


        $comp2 = new Competence();
        $comp2->setNom("HTML");
        $comp2->addUser($this->getReference("user1"));
        $comp2->setCategorie($this->getReference("cat-dev"));
        $comp2->addProjet($this->getReference("projet-2"));
        $manager->persist($comp2);
        $this->addReference("comp-2", $comp2);

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
