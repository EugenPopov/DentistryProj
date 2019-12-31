<?php

namespace App\Repository;

use App\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Service|null find($id, $lockMode = null, $lockVersion = null)
 * @method Service|null findOneBy(array $criteria, array $orderBy = null)
 * @method Service[]    findAll()
 * @method Service[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Service::class);
    }

    /**
     * @return Service|null
     * @throws NonUniqueResultException
     */
    public function getLastQueue(): ?Service
    {
        return $this->createQueryBuilder('service')
            ->orderBy('service.queue', 'DESC')
            ->setMaxResults(1)
            ->getQuery()->getOneOrNullResult();
    }

    /**
     * @param int $id
     * @return Service
     * @throws NonUniqueResultException
     */
    public function getSubServicesByService(int $id): ?Service
    {
        return $this->createQueryBuilder('service')
            ->leftJoin('service.mini_service', 'mini_service')
            ->select('service', 'mini_service')
            ->where('service.id =:id')
            ->setParameter('id', $id)
            ->getQuery()->getOneOrNullResult();
    }

    public function getAnyButNotThis(int $id, int $limit = 3)
    {
        return $this->createQueryBuilder('service')
            ->where('service.id !=:id')
            ->setParameter('id', $id)
            ->setMaxResults($limit)
            ->getQuery()->getResult();
    }
}
