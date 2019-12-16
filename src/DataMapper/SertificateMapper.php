<?php


namespace App\DataMapper;


use App\Entity\EntityInterface;
use App\Entity\Sertificate;
use App\Model\ModelInterface;
use App\Model\SertificateModel;

class SertificateMapper implements DataMapperInterface
{

    public function entityToModel(EntityInterface $entity)
    {
        /** @var Sertificate $entity */
        $model = new SertificateModel();

        return $model
            ->setDoctor($entity->getDoctor())
            ->setTitle($entity->getTitle());
    }

    public function modelToEntity(ModelInterface $model, EntityInterface $entity)
    {
        /** @var SertificateModel $model */
        /** @var Sertificate $entity */
        return $entity
            ->setTitle($model->getTitle())
            ->setDoctor($model->getDoctor());
    }
}