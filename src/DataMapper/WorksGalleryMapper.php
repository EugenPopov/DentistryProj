<?php


namespace App\DataMapper;


use App\Entity\EntityInterface;
use App\Entity\WorksGallery;
use App\Model\ModelInterface;
use App\Model\WorksGalleryModel;

class WorksGalleryMapper implements DataMapperInterface
{

    public function entityToModel(EntityInterface $entity): WorksGalleryModel
    {
        return new WorksGalleryModel();
    }

    /**
     * @param ModelInterface $model
     * @param EntityInterface $entity
     * @return WorksGallery
     */
    public function modelToEntity(ModelInterface $model, EntityInterface $entity): WorksGallery
    {
        /** @var $model WorksGalleryModel */
        /** @var $entity WorksGallery */

        return $entity;

    }
}