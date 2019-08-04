<?php

namespace App\Repository;

use App\Entity\categorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Mapping as ORM;


/**
 * @method categorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method categorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method categorie[]    findAll()
 * @method categorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method categorie[]    findByTerm(string $term) 
 */
class CategorieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, categorie::class);
    }

    // /**
    //  * @return categorie[] Returns an array of categorie objects
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
    public function findOneBySomeField($value): ?categorie
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByTerm($term)
    {
        return $this->getEntityManager()
                    ->createQuery("SELECT c FROM App\Entity\Categorie c WHERE c.term='".$term."' ")
                    ->getResult();
    }
}
