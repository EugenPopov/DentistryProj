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

        return $model->setLink($entity->getLink());
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

        return $entity
            ->setLink($model->getLink());

    }
}