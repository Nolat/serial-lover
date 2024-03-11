<?php

namespace App\DataFixtures;

use App\Entity\Player;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlayerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $player = new Player();
        $player->setFirstname('test')
            ->setLastname('player');
        $manager->persist($player);


        $player2 = new Player();
        $player2->setFirstname('test2')
            ->setLastname('player2');
        $manager->persist($player2);

        $manager->flush();
    }
}
