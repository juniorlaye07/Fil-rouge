<?php

namespace App\Repository;

use App\Entity\DepotArgent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DepotArgent|null find($id, $lockMode = null, $lockVersion = null)
 * @method DepotArgent|null findOneBy(array $criteria, array $orderBy = null)
 * @method DepotArgent[]    findAll()
 * @method DepotArgent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepotArgentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DepotArgent::class);
    }

    // /**
    //  * @return DepotArgent[] Returns an array of DepotArgent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DepotArgent
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
