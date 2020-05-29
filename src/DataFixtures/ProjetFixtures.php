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
        $projet1->setNom("Manucure Zen");
        $projet1->setDateCreation(new \ DateTime('01/02/2020'));
        $projet1->setNomEntreprise("Belle et Zen");
        $projet1->setImage("image1.jpg");
        $projet1->setExtrait("Lorem ipsum dolor sit amet, consectetur adipiscing elit.");
        $projet1->setContenu("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed auctor leo. In ullamcorper felis orci, at vestibulum velit blandit et. Curabitur enim nunc, Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus ultricies ipsum libero. Aliquam mollis, .");
        $projet1->setUser($this->getReference("user-admin"));

        $manager->persist($projet1);
        $this->addReference("projet-1", $projet1);

        $projet2 = new Projet();
        $projet2->setNom("V&D");
        $projet2->setDateCreation(new \ DateTime('04/03/2020'));
        $projet2->setNomEntreprise("Bière Shop");
        $projet2->setImage("image2.jpg");
        $projet2->setExtrait("Lorem ipsum dolor sit amet, consectetur adipiscing elit.");
        $projet2->setContenu("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce sed auctor leo. In ullamcorper felis orci, at vestibulum velit blandit et. Curabitur enim nunc, Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus ultricies ipsum libero. Aliquam mollis, .");
        $projet2->setUser($this->getReference("user1"));

        $manager->persist($projet2);
        $this->addReference("projet-2", $projet2);


        $manager->flush();
    }

    public function getDependencies()
    {
       return[
           UserFixtures::class
       ];
    }
}
