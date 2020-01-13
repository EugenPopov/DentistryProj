<?php


namespace App\DataMapper;


use App\Entity\Doctor;
use App\Entity\EntityInterface;
use App\Model\DoctorModel;
use App\Model\ModelInterface;
use Symfony\Component\Serializer\SerializerInterface;

class DoctorMapper implements DataMapperInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;


    /**
     * DoctorMapper constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function entityToModel(EntityInterface $entity): DoctorModel
    {
        /** @var Doctor $entity */

        $model = new DoctorModel();

        if($entity->getServices())
            $model->setServices($this->serializer->serialize($entity->getServices(), 'json'));
        else
            $model->setServices(json_encode([]));

        return $model
            ->setUniversity($entity->getUniversity())
            ->setSpeciality($entity->getSpeciality())
            ->setExperience($entity->getExperience())
            ->setSeoTitle($entity->getSeoTitle())
            ->setSeoDescription($entity->getSeoDescription())
            ->setName($entity->getName());
    }

    public function modelToEntity(ModelInterface $model, EntityInterface $entity): Doctor
    {
        /** @var DoctorModel $model */
        /** @var Doctor $entity */

        return $entity
            ->setName($model->getName())
            ->setExperience($model->getExperience())
            ->setSpeciality($model->getSpeciality())
            ->setSeoTitle($model->getSeoTitle())
            ->setSeoDescription($model->getSeoDescription())
            ->setUniversity($model->getUniversity());
    }
}