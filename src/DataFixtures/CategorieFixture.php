<?php


namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i <=20; $i++) {

            $categorie = new Categorie();
            $categorie->setName('mute');
            $categorie->setName('sad');
            $this->addReference('mute', $categorie);

            $manager->persist($categorie);

        }

        $manager->flush();
    }
}
