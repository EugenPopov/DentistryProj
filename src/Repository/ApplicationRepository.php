<?php

namespace App\Repository;

use App\Entity\Application;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Application|null find($id, $lockMode = null, $lockVersion = null)
 * @method Application|null findOneBy(array $criteria, array $orderBy = null)
 * @method Application[]    findAll()
 * @method Application[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApplicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Application::class);
    }

    public function getNewApplicationsAmount()
    {
        return $this->createQueryBuilder('application')
            ->select('count(application)')
            ->where('application.is_new =:is_new')
            ->setParameter('is_new', true)
            ->getQuery()->getOneOrNullResult();
    }

    public function getSearchQuery()
    {
        return $this->createQueryBuilder('application')
            ->orderBy('application.is_new', 'DESC')
            ->addOrderBy('application.created_at', 'DESC')
            ->getQuery();
    }
}
