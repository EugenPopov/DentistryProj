<?php

namespace App\Repository;

use App\Entity\Doctor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Doctor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Doctor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Doctor[]    findAll()
 * @method Doctor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Doctor::class);
    }

    public function getLastQueue(): ?Doctor
    {
        return $this->createQueryBuilder('doctor')
            ->orderBy('doctor.queue', 'DESC')
            ->setMaxResults(1)
            ->getQuery()->getOneOrNullResult();
    }

    public function getAllRelatedTables(int $id): ?Doctor
    {
        return $this->createQueryBuilder('doctor')
            ->leftJoin('doctor.services', 'services')
            ->leftJoin('doctor.sertificates', 'sertificates')
            ->where('doctor.id =:id')
            ->setParameter('id', $id)
            ->getQuery()->getOneOrNullResult();
    }
}
