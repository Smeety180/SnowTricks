<?php

namespace App\DataFixtures;

use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Datetime;

class CommentaireFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $com1 = new Commentaire();
        $datemsg = new DateTime();
        $datemsg = DateTime::createFromFormat('d-m-Y H:i:s', '04-05-2023 12:00:00');
        $com1->setDateMsg($datemsg);
        $com1->setContenu('il était une fois.....');
        $this->addReference('mute', $com1);
        $toto = $this->getReference('utilisateur');
        $com1->setUser($toto);

        $manager->persist($com1); // Ajoutez cette ligne pour persister l'objet Commentaire
        $manager->flush();
    }
}
