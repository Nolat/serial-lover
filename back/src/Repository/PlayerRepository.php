<?php

namespace App\Repository;

use App\Entity\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Player>
 *
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Player::class);
    }

    public function search($datas) {
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.lastname', 'ASC');

        if (isset($datas['search']) && $datas['search']) {
            $qb ->andWhere('p.firstname LIKE :search OR p.lastname LIKE :search')
                ->setParameter('search', '%'.$datas['search'].'%');
        }

        return  $qb->getQuery()->getResult();
    }

    public function findRandomTarget(Player $player) {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.id NOT IN (:targets)')
            ->andWhere('p.id != :player')
            ->setParameter('targets', $player->getTargetFromPlayerQuests())
            ->setParameter('player', $player->getId())
            ->getQuery()->getResult();
        if ($qb) {
            return $qb[random_int(0, count($qb) -1)];
        }
        return null;
    }

    //    /**
    //     * @return Player[] Returns an array of Player objects
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

    //    public function findOneBySomeField($value): ?Player
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
