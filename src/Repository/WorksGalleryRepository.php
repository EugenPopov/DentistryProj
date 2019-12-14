<?php

namespace App\Repository;

use App\Entity\WorksGallery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method WorksGallery|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorksGallery|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorksGallery[]    findAll()
 * @method WorksGallery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorksGalleryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorksGallery::class);
    }

    // /**
    //  * @return WorksGallery[] Returns an array of WorksGallery objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorksGallery
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
