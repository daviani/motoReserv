<?php

namespace App\Repository;

use App\Entity\BikeOwner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BikeOwner|null find($id, $lockMode = null, $lockVersion = null)
 * @method BikeOwner|null findOneBy(array $criteria, array $orderBy = null)
 * @method BikeOwner[]    findAll()
 * @method BikeOwner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BikeOwnerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BikeOwner::class);
    }

    // /**
    //  * @return BikeOwner[] Returns an array of BikeOwner objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BikeOwner
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
