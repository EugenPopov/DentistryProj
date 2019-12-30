<?php


namespace App\DataMapper;


use App\Entity\EntityInterface;
use App\Entity\Review;
use App\Model\ModelInterface;
use App\Model\ReviewModel;

class ReviewMapper implements DataMapperInterface
{

    public function entityToModel(EntityInterface $entity)
    {
        /** @var Review $entity */
        $model = new ReviewModel();
        return $model
            ->setName($entity->getName())
            ->setText($entity->getDescription());
    }

    public function modelToEntity(ModelInterface $model, EntityInterface $entity): Review
    {
        /** @var ReviewModel $model */
        /** @@var Review $entity */

        return $entity
            ->setName($model->getName())
            ->setDescription($model->getText());

    }
}