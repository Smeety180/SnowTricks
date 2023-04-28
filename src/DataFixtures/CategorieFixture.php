<?php


namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //        Test premiere categorie de figure fixture
        $grabs = new Categorie();
        $grabs->setNom('Grabs');
        $manager->persist($grabs);
        $this->addReference('grabs', $grabs);

        $rotations = new Categorie();
        $rotations->setNom('Rotations');
        $manager->persist($rotations);
        $this->addReference('rotations', $rotations);

        //        Test premiere categorie de figure fixture

        $manager->flush();
    }
}
