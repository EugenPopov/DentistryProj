<?php


namespace App\DataMapper;


use App\Entity\EntityInterface;
use App\Entity\Promotion;
use App\Model\ModelInterface;
use App\Model\PromotionModel;

class PromotionMapper implements DataMapperInterface
{

    public function entityToModel(EntityInterface $entity)
    {
        /** @var Promotion $entity */
        $model = new PromotionModel();
        return $model
            ->setTitle($entity->getTitle())
            ->setDescription($entity->getDescription())
            ->setIsActive($entity->getIsActive())
            ->setIsPublic($entity->getIsPublic());
    }

    public function modelToEntity(ModelInterface $model, EntityInterface $entity)
    {
        /** @var PromotionModel $model */
        /** @var Promotion $entity */
        return $entity
            ->setTitle($model->getTitle())
            ->setDescription($model->getDescription())
            ->setIsActive($model->getIsActive())
            ->setIsPublic($model->getIsPublic());
    }
}