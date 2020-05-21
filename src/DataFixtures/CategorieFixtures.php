<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $categories = ["dev", "marketing", "design"];

        foreach ($categories as $cat) {
            $categorie = new Categorie();
            $categorie->setNom(ucfirst($cat));
            $manager->persist($categorie);
            $this->addReference("cat-$cat", $categorie);
        }
        $manager->flush();
    }


}
