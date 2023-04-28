<?php

namespace App\DataFixtures;

use App\Entity\Figure;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FigureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        //        Test premiere figure fixture
        $mute = new Figure();
        $mute->setNom('Mute');
        $mute->setDescription('Description de la figure mute');
        $mute->setCategorie($this->getReference('grabs'));
        $mute->setUser($this->getReference('admin'));

        $muteImage = new Image();
        $muteImage->setNomDeFichier('mute.jpg');
        $mute->addImage($muteImage);

        $manager->persist($mute);
        $this->addReference('mute', $mute);

        //        Test premiere figure fixture

        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategorieFixture::class, UserFixtures::class];
    }
}
