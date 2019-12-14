<?php

namespace App\Repository;

use App\Entity\Sertificate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Sertificate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sertificate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sertificate[]    findAll()
 * @method Sertificate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SertificateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sertificate::class);
    }

    // /**
    //  * @return Sertificate[] Returns an array of Sertificate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sertificate
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
