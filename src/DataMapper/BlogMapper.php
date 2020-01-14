<?php


namespace App\DataMapper;


use App\Entity\Blog;
use App\Entity\EntityInterface;
use App\Model\BlogModel;
use App\Model\ModelInterface;

class BlogMapper implements DataMapperInterface
{

    public function entityToModel(EntityInterface $entity)
    {
        $model = new BlogModel();
        return $model
            ->setTitle($entity->getTitle())
            ->setDescription($entity->getDescription())
            ->setSeoTitle($entity->getSeoTitle())
            ->setSeoDescription($entity->getSeoDescription());
    }

    public function modelToEntity(ModelInterface $model, EntityInterface $entity)
    {
        /** @var Blog $entity */
        return $entity
            ->setTitle($model->getTitle())
            ->setDescription($model->getDescription())
            ->setSeoTitle($model->getSeoTitle())
            ->setSeoDescription($model->getSeoDescription());
    }
}