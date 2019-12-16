<?php


namespace App\DataMapper;


use App\Entity\EntityInterface;
use App\Entity\Service;
use App\Model\ModelInterface;
use App\Model\ServiceModel;
use App\Service\MiniServiceService;

class ServiceMapper implements DataMapperInterface
{
    /**
     * @var MiniServiceService
     */
    private $miniServiceService;


    /**
     * ServiceMapper constructor.
     * @param MiniServiceService $miniServiceService
     */
    public function __construct(MiniServiceService $miniServiceService)
    {
        $this->miniServiceService = $miniServiceService;
    }

    public function entityToModel(EntityInterface $entity): ServiceModel
    {
        /** @var Service $entity */
        $model = new ServiceModel();

        return $model
            ->setAdditionalInfo($entity->getAdditionalInfo())
            ->setTitle($entity->getTitle())
            ->setDescription($entity->getDescription())
            ->setMiniServices($this->miniServiceService->getAllInJson());
    }

    public function modelToEntity(ModelInterface $model, EntityInterface $entity): Service
    {
        /** @var ServiceModel $model */
        /** @var Service $entity */
        return $entity
            ->setDescription($model->getDescription())
            ->setTitle($model->getTitle())
            ->setAdditionalInfo($model->getAdditionalInfo());
    }
}