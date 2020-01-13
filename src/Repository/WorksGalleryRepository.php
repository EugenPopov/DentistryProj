<?php

namespace App\Repository;

use App\Entity\MainPageSlider;
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

    public function getLastQueue(): ?WorksGallery
    {
        return $this->createQueryBuilder('works_gallery')
            ->orderBy('works_gallery.queue', 'DESC')
            ->setMaxResults(1)
            ->getQuery()->getOneOrNullResult();
    }
}
