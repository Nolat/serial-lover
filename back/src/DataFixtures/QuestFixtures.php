<?php

namespace App\DataFixtures;

use App\Entity\Player;
use App\Entity\PlayerQuest;
use App\Entity\Quest;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuestFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $quest = new Quest();
        $quest->setContent('Vous devez effectuer un triple salto arrière et effectuer un high five a chaque salto à la cible');
        $manager->persist($quest);

        $quest2 = new Quest();
        $quest2->setContent('Vous devez faire une contre soirée avec la cible en regardant un compilation 10h de petit poney jusqu\'à la fin');
        $manager->persist($quest2);

        $players = $manager->getRepository(Player::class)->findAll();

        $playerQuest = new PlayerQuest();
        $playerQuest->setPlayer($players[0])
            ->setTarget($players[1])
            ->setQuest($quest)
            ->setValid(true)
            ->setValidatedDate(new \DateTime());
        $manager->persist($playerQuest);


        $playerQuest2 = new PlayerQuest();
        $playerQuest2->setPlayer($players[0])
            ->setTarget($players[1])
            ->setQuest($quest2);
        $manager->persist($playerQuest2);

        $playerQuest3 = new PlayerQuest();
        $playerQuest3->setPlayer($players[1])
            ->setTarget($players[0])
            ->setQuest($quest);
        $manager->persist($playerQuest3);

        $manager->flush();
    }


    public function getDependencies(): array
    {
        return [
            PlayerFixtures::class,
        ];
    }
}
