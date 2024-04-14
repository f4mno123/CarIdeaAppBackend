<?php

namespace App\Repository;

use App\Entity\UserSellingItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserSellingItem>
 *
 * @method UserSellingItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserSellingItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserSellingItem[]    findAll()
 * @method UserSellingItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserSellingItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSellingItem::class);
    }

//    /**
//     * @return UserSellingItem[] Returns an array of UserSellingItem objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserSellingItem
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
