<?php

namespace App\Controller;

use App\Controller\AbstractController\AbstractApiController;
use App\Entity\Player;
use App\Entity\PlayerQuest;
use App\Service\PlayerQuestService;
use App\Service\PlayerService;
use App\Service\QuestService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[Route('/api/player_quests', name: 'api_player_quests_')]
class PlayerQuestController extends AbstractApiController
{
    #[OA\Response(
        response: 200,
        description: "Retourne la nouvelle quête du joueur",
        content: new Model(type: PlayerQuest::class, groups: ['player_quest_get', 'quest_get', 'player_get'])
    )]
    #[OA\RequestBody(
        description: "Envoi l'id du joueur à qui valider sa quête en cours et lui en associer une nouvelle",
        required: true,
        content: [new OA\MediaType(mediaType: "multipart/form-data",
            schema: new OA\Schema(
                properties: [new OA\Property(property: "player", type: "int",description: "id du joueur")]
            )
        )]
    )]
    #[OA\Tag(name: 'player_quests',description: "API Player Quests")]
    #[Route('/valid', name: 'valid_player_quest', methods: 'POST')]
    public function validPlayerQuest(Request $request, PlayerQuestService $playerQuestService, QuestService $questService, PlayerService $playerService) {
        try {
            $datas = json_decode($request->getContent(), true);
            $player = $this->entityManager->getRepository(Player::class)->find($datas['player']);

            $playerQuestService->validPlayerQuest($player);

            $newQuest = $playerQuestService->createPlayerQuest($player);

            return $this->renderSerializeJson($newQuest, ['player_quest_get', 'quest_get', 'player_get']);

        } catch (\Exception $e) {
            return new JsonResponse('Une erreur c\'est produite',500, [], true);
        }
    }

    #[OA\Response(
        response: 200,
        description: "Retourne la premère quête du joueur",
        content: new Model(type: PlayerQuest::class, groups: ['player_quest_get', 'quest_get', 'player_get'])
    )]
    #[OA\RequestBody(
        description: "Envoi l'id du joueur à qui associer sa première quête",
        required: true,
        content: [new OA\MediaType(mediaType: "multipart/form-data",
            schema: new OA\Schema(
                properties: [new OA\Property(property: "player", type: "int",description: "id du joueur")]
            )
        )]
    )]
    #[OA\Tag(name: 'player_quests',description: "API Player Quests")]
    #[Route('', name: 'first_player_quest', methods: 'POST')]
    public function firstPlayerQuest(Request $request, PlayerQuestService $playerQuestService, QuestService $questService, PlayerService $playerService) {
        try {
            $datas = json_decode($request->getContent(), true);
            $player = $this->entityManager->getRepository(Player::class)->find($datas['player']);

            $currentQuest = $this->entityManager->getRepository(PlayerQuest::class)->findCurrentQuest($player);

            if (!$currentQuest) {
                $newQuest = $playerQuestService->createPlayerQuest($player);
                if ($newQuest) {
                    return $this->renderSerializeJson($newQuest, ['player_quest_get', 'quest_get', 'player_get']);
                }

                return new JsonResponse('Aucune quête disponible',500, [], true);
            }

            return new JsonResponse('Vous avez déjà un quête en cours',500, [], true);
        } catch (\Exception $e) {
            return new JsonResponse('Une erreur c\'est produite',500, [], true);
        }
    }
}
