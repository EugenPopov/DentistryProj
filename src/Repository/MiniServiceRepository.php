<?php

namespace App\Repository;

use App\Entity\MiniService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MiniService|null find($id, $lockMode = null, $lockVersion = null)
 * @method MiniService|null findOneBy(array $criteria, array $orderBy = null)
 * @method MiniService[]    findAll()
 * @method MiniService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MiniServiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MiniService::class);
    }

    public function getMiniServiceArray($id = null): array
    {
        $query = $this->createQueryBuilder('mini_service')
            ->select('mini_service.id', 'mini_service.title');

        if($id){
            $query
                ->leftJoin('mini_service.services', 'services')
                ->where('services.id =:id')
                ->setParameter('id', $id);
        }

        return $query->getQuery()->getResult();
    }
}
