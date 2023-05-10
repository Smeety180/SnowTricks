<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use Datetime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentaireFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $com1 = new Commentaire();
        $datemsg = DateTime::createFromFormat('d-m-Y H:i:s', '04-05-2023 12:00:00');
        $com1->setDateMsg($datemsg);
        $com1->setContenu('il était une fois.....');
        $toto = $this->getReference('utilisateur');
        $com1->setUser($toto);
        $melon = $this->getReference('melon');
        $com1->setFigure($melon);


        $manager->persist($com1); // Ajoutez cette ligne pour persister l'objet Commentaire
        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class, FigureFixtures::class];
    }


}
