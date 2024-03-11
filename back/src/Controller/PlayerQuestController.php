<?php

namespace App\Controller;

use App\Controller\AbstractController\AbstractApiController;
use App\Entity\Player;
use App\Entity\PlayerQuest;
use App\Entity\Quest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Date;

#[Route('/api/player_quests', name: 'api_player_quests_')]
class PlayerQuestController extends AbstractApiController
{
    #[Route('/valid', name: 'valid_quest', methods: 'POST')]
    public function validQuest(Request $request) {
        $datas = json_decode($request->getContent(), true);
        $player = $this->entityManager->getRepository(Player::class)->find($datas['player']);
        $currentQuest = $this->entityManager->getRepository(PlayerQuest::class)->findCurrentQuest($player);

        $currentQuest->setValid(true)
            ->setValidatedDate(new \DateTime());

        $this->entityManager->persist($currentQuest);

        $quest = $this->entityManager->getRepository(Quest::class)->findRandomQuest($player);
        $target = $this->entityManager->getRepository(Player::class)->findRandomTarget($player);

        if (!$quest || !$target) {
            return new JsonResponse('Aucune quête ou cible disponible',500, [], true);
        }
        $newQuest = new PlayerQuest();
        $newQuest->setQuest($quest)
            ->setPlayer($player)
            ->setTarget($target);
        $this->entityManager->persist($newQuest);
        $this->entityManager->flush();

        return $this->renderSerializeJson($newQuest, ['player_quest_get']);
    }
}
