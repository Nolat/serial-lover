<?php

namespace App\Repository;

use App\Entity\Player;
use App\Entity\PlayerQuest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlayerQuest>
 *
 * @method PlayerQuest|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerQuest|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerQuest[]    findAll()
 * @method PlayerQuest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerQuestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerQuest::class);
    }

    public function findCurrentQuest(Player $player) {
        return $this->createQueryBuilder('p')
            ->setParameter('player', $player)
            ->setParameter('valid', false)
            ->andWhere('p.player = :player')
            ->andWhere('p.valid = :valid')
            ->getQuery()->getSingleResult();
    }

    //    /**
    //     * @return PlayerQuest[] Returns an array of PlayerQuest objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?PlayerQuest
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
