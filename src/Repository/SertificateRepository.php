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

    public function getLastQueue(): ?Sertificate
    {
        return $this->createQueryBuilder('doctor')
            ->orderBy('doctor.queue', 'DESC')
            ->setMaxResults(1)
            ->getQuery()->getOneOrNullResult();
    }
}
