<?php

namespace App\Tests;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class PlayerApiTest extends WebTestCase
{

    public function testSearch(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/players');
        $players = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals([], $players);

        $client->request('GET', '/api/players?search=t');
        $players = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertCount(2, $players);
    }

    public function testUpdatePlayer() {
        $client = static::createClient();

        $client->request('PUT', '/api/players/1',[], [], [], json_encode(['is_playing' => true]));
        $players = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(true, $players['is_playing']);

        $client->request('PUT', '/api/players/1',[], [], [], json_encode(['is_playing' => false]));
        $player = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(false, $player['is_playing']);
    }

    public function testGetCurrentPlayerQuest() {
        $client = static::createClient();

        $client->request('GET', '/api/players/1/quest');
        $player = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(2, $player['quest']['id']);
    }

    public function testGetCurrentPlayerScore() {
        $client = static::createClient();

        $client->request('GET', '/api/players/1/score');
        $player = json_decode($client->getResponse()->getContent(), true);
        $this->assertResponseIsSuccessful();
        $this->assertEquals(1, $player['score']);
    }
}
