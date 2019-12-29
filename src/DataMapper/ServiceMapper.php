<?php


namespace App\DataMapper;


use App\Entity\EntityInterface;
use App\Entity\Service;
use App\Model\ModelInterface;
use App\Model\ServiceModel;
use App\Service\MiniServiceService;
use Symfony\Component\Serializer\SerializerInterface;

class ServiceMapper implements DataMapperInterface
{
    /**
     * @var MiniServiceService
     */
    private $miniServiceService;
    /**
     * @var SerializerInterface
     */
    private $serializer;


    /**
     * ServiceMapper constructor.
     * @param MiniServiceService $miniServiceService
     * @param SerializerInterface $serializer
     */
    public function __construct(MiniServiceService $miniServiceService, SerializerInterface $serializer)
    {
        $this->miniServiceService = $miniServiceService;
        $this->serializer = $serializer;
    }

    public function entityToModel(EntityInterface $entity): ServiceModel
    {
        /** @var Service $entity */
        $model = new ServiceModel();

        if($entity->getMiniService())
            $model->setMiniServices($this->serializer->serialize($entity->getMiniService(), 'json'));
        else
            $model->setMiniServices(json_encode([]));

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