<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
//        Test premier utilisateur
        $admin = new User();
        $admin->setPrenom('John');
        $admin->setNom('Doe');
        $admin->setPseudo('john');
        $admin->setPhoto('john.jpg');
        $admin->setEmail('admin@snowtricks.com');
        $admin->setPassword($this->hasher->hashPassword($admin, 'azerty'));
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);
        $this->addReference('admin', $admin);

//        Test premier utilisateur

        $manager->flush();
    }
}
