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
        $projet1->setNom("manucure zen");
        $projet1->setDateCreation(new \ DateTime('01/02/2020'));
        $projet1->setNomEntreprise("belle et zen");
        $projet1->setImage("image1.jpg");
        $projet1->setExtrait("Lorem ipsum dolor sit amet, consectetur adipiscing elit.");
        $projet1->setContenu("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed auctor leo. In ullamcorper felis orci, at vestibulum velit blandit et. Curabitur enim nunc, Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus ultricies ipsum libero. Aliquam mollis, .");
        $projet1->setUser($this->getReference("user-admin"));
        $manager->persist($projet1);
        $this->addReference("projet-1", $projet1);

        $manager->flush();
    }

    public function getDependencies()
    {
       return[
           UserFixtures::class
       ];
    }
}
