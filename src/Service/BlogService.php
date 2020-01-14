<?php


namespace App\Service;


use App\DataMapper\BlogMapper;
use App\Entity\EntityInterface;
use App\Model\ModelInterface;
use App\Repository\BlogRepository;
use App\Service\CrudManager\CrudManager;
use App\Service\FileManager\FileManager;
use Doctrine\ORM\EntityManagerInterface;

class BlogService extends CrudManager
{
    private const IMG_UPLOAD_DIR = 'blog/';
    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * MainPageSliderService constructor.
     * @param BlogRepository $repository
     * @param EntityManagerInterface $entityManager
     * @param BlogMapper $mapper
     * @param FileManager $fileManager
     */
    public function __construct(BlogRepository $repository, EntityManagerInterface $entityManager, BlogMapper $mapper, FileManager $fileManager)
    {
        parent::__construct($repository ,$entityManager, $mapper);
        $this->fileManager = $fileManager;
    }

    public function create(ModelInterface $model, EntityInterface $entity)
    {
        $entity = $this->mapper->modelToEntity($model, $entity);
        $entity->setQueue($this->getLastQueue());

        $uploadedFile = $this->fileManager->uploadFile($model->getImage(), self::IMG_UPLOAD_DIR);
        $entity->setImage(self::IMG_UPLOAD_DIR . $uploadedFile);

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
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    private function getLastQueue(): int
    {
        $queue = $this->repository->getLastQueue();

        return $queue ? $queue->getQueue()+1:0;
    }
}