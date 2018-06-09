<?php

namespace App\Repository;

use App\Entity\HotWord;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method HotWord|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotWord|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotWord[]    findAll()
 * @method HotWord[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotWordRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, HotWord::class);
    }

//    /**
//     * @return HotWord[] Returns an array of HotWord objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HotWord
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
