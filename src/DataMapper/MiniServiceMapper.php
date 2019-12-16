<?php


namespace App\DataMapper;


use App\Entity\EntityInterface;
use App\Model\MiniServiceModel;
use App\Model\ModelInterface;

class MiniServiceMapper implements DataMapperInterface
{

    public function entityToModel(EntityInterface $entity): MiniServiceModel
    {
        $model = new MiniServiceModel();

        return $model
            ->setTitle($entity->getTitle())
            ->setPrice($entity->getPrice());
    }

    public function modelToEntity(ModelInterface $model, EntityInterface $entity)
    {
        return $entity
            ->setTitle($model->getTitle())
            ->setPrice($model->getPrice());
    }
}