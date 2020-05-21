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
        $competence1 = new Competence();
        $competence1->setNom("PHP");
        $competence1->setCategorie($this->getReference("cat-dev"));
        $manager->persist($competence1);
        $this->addReference("comp-1", $competence1);

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            CategorieFixtures::class
        ];
    }

}
