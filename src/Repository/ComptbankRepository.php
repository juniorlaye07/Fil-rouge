<?php

namespace App\Repository;

use App\Entity\Comptbank;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Comptbank|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comptbank|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comptbank[]    findAll()
 * @method Comptbank[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComptbankRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Comptbank::class);
    }

    // /**
    //  * @return Comptbank[] Returns an array of Comptbank objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Comptbank
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
