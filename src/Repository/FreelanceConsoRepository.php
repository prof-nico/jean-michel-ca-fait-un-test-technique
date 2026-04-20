<?php

namespace App\Repository;

use App\Entity\FreelanceConso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends ServiceEntityRepository<FreelanceConso>
 */
class FreelanceConsoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FreelanceConso::class);
    }

    #[ArrayShape(['firstName' => "string", 'quantity' => "int"])]
    public function findTheMostUseFirstname(): ?array
    {
        return $this->createQueryBuilder('f')
            ->select('f.firstName, COUNT(f.firstName) as quantity')
            ->groupBy('f.firstName')
            ->orderBy('quantity', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //    /**
    //     * @return FreelanceConso[] Returns an array of FreelanceConso objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?FreelanceConso
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
