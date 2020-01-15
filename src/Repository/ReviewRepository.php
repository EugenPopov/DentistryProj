<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Review|null find($id, $lockMode = null, $lockVersion = null)
 * @method Review|null findOneBy(array $criteria, array $orderBy = null)
 * @method Review[]    findAll()
 * @method Review[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function getLastQueue(): ?Review
    {
        return $this->createQueryBuilder('review')
            ->orderBy('review.queue', 'DESC')
            ->setMaxResults(1)
            ->getQuery()->getOneOrNullResult();
    }

    public function getAllByQueueArray()
    {
        return $this->createQueryBuilder('review')
            ->select('review.id', 'review.name', 'review.description', 'review.image')
            ->orderBy('review.queue', 'ASC')
            ->getQuery()->getResult();
    }
}
