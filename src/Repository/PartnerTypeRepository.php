<?php

namespace App\Repository;

use App\Entity\PartnerType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PartnerType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartnerType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartnerType[]    findAll()
 * @method PartnerType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnerTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PartnerType::class);
    }

//    /**
//     * @return PartnerType[] Returns an array of PartnerType objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PartnerType
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
