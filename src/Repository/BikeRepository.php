<?php

namespace App\Repository;

use App\Entity\Bike;
use App\Entity\BikeOwner;
use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bike|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bike|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bike[]    findAll()
 * @method Bike[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Bike[]    findByStatus($status)
 */
class BikeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bike::class);
    }

    /**
     * @param BikeOwner|null $bikeOwner
     * @param Tag[] $tags
     * @return Bike[] Returns an array of Bike objects
     */
    public function findOldBikeAvailable(BikeOwner $bikeOwner = null, array $tags = [])
    {
        $qb = $this->createQueryBuilder('b');

        $qb
            ->where('b.productionYear < :oldDate')
            ->andWhere('b.status = 1')
            ->orderBy('b.productionYear', 'ASC')
            ->setMaxResults(10)
        ;

        if (null !== $bikeOwner) {
            $qb
                ->andWhere('b.bikeOwner = :bikeOwner')
                ->setParameter('bikeOwner', $bikeOwner)
            ;
        }

        if (!empty($tags)) {
            $qb
                ->innerJoin('b.tags', 't')
                ->andWhere('t IN (:tags)')
                ->setParameter('tags', $tags)
            ;
        }

        // Parameters
        $date = new \DateTime();
        $date->sub(new \DateInterval('P30Y'));
        $qb->setParameter('oldDate', $date);

        return $qb
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Bike
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
