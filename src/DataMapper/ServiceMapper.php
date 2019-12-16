<?php


namespace App\DataMapper;


use App\Entity\EntityInterface;
use App\Entity\Service;
use App\Model\ModelInterface;
use App\Model\ServiceModel;

class ServiceMapper implements DataMapperInterface
{

    public function entityToModel(EntityInterface $entity): ServiceModel
    {
        /** @var Service $entity */
        $model = new ServiceModel();

        return $model
            ->setAdditionalInfo($entity->getAdditionalInfo())
            ->setTitle($entity->getTitle())
            ->setDescription($entity->getDescription());
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