<?php

namespace App\Repository;

use App\Entity\beer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method beer|null find($id, $lockMode = null, $lockVersion = null)
 * @method beer|null findOneBy(array $criteria, array $orderBy = null)
 * @method beer[]    findAll()
 * @method beer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, beer::class);
    }

    // /**
    //  * @return beer[] Returns an array of beer objects
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
    public function findOneBySomeField($value): ?beer
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByNote($note)
    {
        return $this->getEntityManager()
                    ->createQuery("SELECT c FROM App\Entity\beer c WHERE c.note='".$note."' ORDER BY c.Price")
                    ->getResult();
    }

    public function bestBeer(){
        return $this->getEntityManager()
                    ->createQuery("SELECT c from App\Entity\Beer c WHERE c.note = 'very good' ORDER BY c.Price DESC")
                    ->getResult();
    }
}
