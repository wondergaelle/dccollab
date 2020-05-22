<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

    /**
     * UserFixtures constructor.
     */

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setNom("Floch");
        $admin->setPrenom("Gaëlle");
        $admin->setEmail("gaelle_floch@hotmail.com");
        $admin->setDateNaissance(new \ DateTime('04/05/1979'));
        $admin->setEcole($this->getReference("ecole-1"));
        $admin->setFiliere($this->getReference("filiere-1"));
        $admin->setPassword($this->encoder->encodePassword($admin, "gafloch"));
        $admin->setRoles(["ROLE_ADMIN"]);
        $manager->persist($admin);
        $this->addReference("user-admin", $admin);

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            EcoleFixtures::class,
            FiliereFixtures::class,


        ];
    }
}
