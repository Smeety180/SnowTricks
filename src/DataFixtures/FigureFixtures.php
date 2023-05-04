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

        //        Test deuxieme figure fixture
        $nose = new Figure();
        $nose->setNom('nose');
        $nose->setDescription('Description de la figure nose');
        $nose->setCategorie($this->getReference('grabs'));
        $nose->setUser($this->getReference('utilisateur'));

        $noseImage = new Image();
        $noseImage->setNomDeFichier('nose.png');
        $nose->addImage($noseImage);

        $manager->persist($nose);
        $this->addReference('nose', $nose);

        //        Test 3 figure fixture
        $melon = new Figure();
        $melon->setNom('melon');
        $melon->setDescription('Description de la figure melon');
        $melon->setCategorie($this->getReference('grabs'));
        $melon->setUser($this->getReference('utilisateur'));

        $melonImage = new Image();
        $melonImage->setNomDeFichier('melon.pdf');
        $melon->addImage($melonImage);

        $manager->persist($melon);
        $this->addReference('melon', $melon);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategorieFixture::class, UserFixtures::class];
    }
}
