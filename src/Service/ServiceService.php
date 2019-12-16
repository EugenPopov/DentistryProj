<?php


namespace App\Service;


use App\DataMapper\ServiceMapper;
use App\Entity\EntityInterface;
use App\Model\ModelInterface;
use App\Repository\ServiceRepository;
use App\Service\CrudManager\CrudManager;
use App\Service\FileManager\FileManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class ServiceService extends CrudManager
{
    private const IMG_UPLOAD_DIR = 'service/';
    /**
     * @var FileManager
     */
    private $fileManager;
    /**
     * @var JsonEncoder
     */
    private $jsonEncoder;

    /**
     * MainPageSliderService constructor.
     * @param ServiceRepository $repository
     * @param EntityManagerInterface $entityManager
     * @param ServiceMapper $mapper
     * @param FileManager $fileManager
     * @param JsonEncoder $jsonEncoder
     */
    public function __construct(ServiceRepository $repository, EntityManagerInterface $entityManager, ServiceMapper $mapper, FileManager $fileManager, SerializerInterface $jsonEncoder)
    {
        parent::__construct($repository ,$entityManager, $mapper);
        $this->fileManager = $fileManager;
        $this->jsonEncoder = $jsonEncoder;
    }

    public function create(ModelInterface $model, EntityInterface $entity)
    {
        $entity = $this->mapper->modelToEntity($model, $entity);
        $entity->setQueue($this->getLastQueue());

        $uploadedFile = $this->fileManager->uploadFile($model->getImage(), self::IMG_UPLOAD_DIR);
        $entity->setImage(self::IMG_UPLOAD_DIR . $uploadedFile);

        $uploadedFile = $this->fileManager->uploadFile($model->getIcon(), self::IMG_UPLOAD_DIR);
        $entity->setIcon(self::IMG_UPLOAD_DIR . $uploadedFile);


        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function update(ModelInterface $model , EntityInterface $entity)
    {
        $entity = $this->mapper->modelToEntity($model, $entity);


        if($model->getImage()){
            $uploadedFile = $this->fileManager->uploadFile($model->getImage(), self::IMG_UPLOAD_DIR);
            $entity->setImage(self::IMG_UPLOAD_DIR . $uploadedFile);
        }

        if($model->getIcon()){
            $uploadedFile = $this->fileManager->uploadFile($model->getIcon(), self::IMG_UPLOAD_DIR);
            $entity->setIcon(self::IMG_UPLOAD_DIR . $uploadedFile);
        }


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
        $this->fileManager->deleteFile($entity->getImage());
        $this->fileManager->deleteFile($entity->getIcon());
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    public function getAllInJson()
    {
        return $this->jsonEncoder->serialize($this->all(), 'json');
    }

    private function getLastQueue(): int
    {
        $queue = $this->repository->getLastQueue();

        return $queue ? $queue->getQueue()+1:0;
    }
}