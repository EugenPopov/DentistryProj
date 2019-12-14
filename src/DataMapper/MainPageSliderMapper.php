<?php


namespace App\DataMapper;


use App\Entity\EntityInterface;
use App\Entity\MainPageSlider;
use App\Model\MainPageSliderModel;
use App\Model\ModelInterface;

class MainPageSliderMapper implements DataMapperInterface
{

    public function entityToModel(EntityInterface $entity): MainPageSliderModel
    {
        $model = new MainPageSliderModel();

        return $model
            ->setTitle($entity->getTitle())
            ->setBoldTitle($entity->getBoldTitle())
            ->setDescription($entity->getDescription());
    }

    /**
     * @param ModelInterface $model
     * @param EntityInterface $entity
     * @return MainPageSlider
     */
    public function modelToEntity(ModelInterface $model, EntityInterface $entity): MainPageSlider
    {
        /** @var $model MainPageSliderModel */
        /** @var $entity MainPageSlider */
        $entity
            ->setDescription($model->getDescription())
            ->setBoldTitle($model->getBoldTitle())
            ->setTitle($model->getTitle());

        return $entity;

    }
}