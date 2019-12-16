<?php


namespace App\Service;


use App\DataMapper\MiniServiceMapper;
use App\Entity\EntityInterface;
use App\Entity\MiniService;
use App\Model\ModelInterface;
use App\Repository\MiniServiceRepository;
use App\Service\CrudManager\CrudManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class MiniServiceService extends CrudManager
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * MainPageSliderService constructor.
     * @param MiniServiceRepository $repository
     * @param EntityManagerInterface $entityManager
     * @param MiniServiceMapper $mapper
     * @param SerializerInterface $serializer
     */
    public function __construct(MiniServiceRepository $repository, EntityManagerInterface $entityManager, MiniServiceMapper $mapper, SerializerInterface $serializer)
    {
        parent::__construct($repository ,$entityManager, $mapper);
        $this->serializer = $serializer;
    }

    public function create(ModelInterface $model, EntityInterface $entity)
    {
        $entity = $this->mapper->modelToEntity($model, $entity);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function createAndReturn(ModelInterface $model): EntityInterface
    {
        $entity = $this->mapper->modelToEntity($model, new MiniService());
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

    public function update(ModelInterface $model , EntityInterface $entity)
    {
        $entity = $this->mapper->modelToEntity($model, $entity);

        $this->entityManager->flush();

        return $entity;
    }

    public function updateQueue(?array $array): void
    {
        if($array){
            $counter = 0;
            foreach ($array as $item) {
                if($entity = $this->repository->find($item)){
                    $entity->setQueue($counter);
                    $counter++;
                }
            }
            $this->entityManager->flush();
        }
    }

    public function delete(EntityInterface $entity): void
    {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    private function getLastQueue(): int
    {
        $queue = $this->repository->getLastQueue();

        return $queue ? $queue->getQueue()+1:0;
    }

    public function getAllInJson()
    {
        return $this->serializer->serialize($this->all(), 'json');
    }
}