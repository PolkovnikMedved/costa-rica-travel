<?php

namespace App\Repository;

use App\Entity\Ios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Ios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ios[]    findAll()
 * @method Ios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IosRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ios::class);
    }

//    /**
//     * @return Ios[] Returns an array of Ios objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ios
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
