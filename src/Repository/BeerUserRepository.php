<?php

namespace App\Repository;

use App\Entity\BeerUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BeerUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method BeerUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method BeerUser[]    findAll()
 * @method BeerUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeerUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BeerUser::class);
    }

    // /**
    //  * @return BeerUser[] Returns an array of BeerUser objects
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
    public function findOneBySomeField($value): ?BeerUser
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
