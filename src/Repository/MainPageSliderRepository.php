<?php

namespace App\Repository;

use App\Entity\MainPageSlider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MainPageSlider|null find($id, $lockMode = null, $lockVersion = null)
 * @method MainPageSlider|null findOneBy(array $criteria, array $orderBy = null)
 * @method MainPageSlider[]    findAll()
 * @method MainPageSlider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MainPageSliderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MainPageSlider::class);
    }

    public function getLastQueue(): ?MainPageSlider
    {
        return $this->createQueryBuilder('main_page_slider')
            ->orderBy('main_page_slider.queue', 'DESC')
            ->setMaxResults(1)
            ->getQuery()->getOneOrNullResult();
    }

}
