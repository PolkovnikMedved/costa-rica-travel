<?php

namespace App\Repository;

use App\Entity\PartnerRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PartnerRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method PartnerRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method PartnerRequest[]    findAll()
 * @method PartnerRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartnerRequestRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PartnerRequest::class);
    }

//    /**
//     * @return PartnerRequest[] Returns an array of PartnerRequest objects
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
    public function findOneBySomeField($value): ?PartnerRequest
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
