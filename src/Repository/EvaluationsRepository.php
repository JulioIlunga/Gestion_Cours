<?php

namespace App\Repository;

use App\Entity\Evaluations;
use App\Entity\Classes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Evaluations>
 */
class EvaluationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evaluations::class);
    }

    public function findByClasseNom(?Classes $classe): array
{
    if(!$classe)
    {
        return [];
    }
    return $this->createQueryBuilder('e')
        ->join('e.class_id', 'c') // Jointure avec l'entité Classes
        ->where('c.name = :classe')
        ->setParameter('classe', $classe)
        ->getQuery()
        ->getResult();
}

    //    /**
    //     * @return Evaluations[] Returns an array of Evaluations objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Evaluations
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
