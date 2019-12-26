<?php


namespace App\Service;


use App\DataMapper\MainPageSliderMapper;
use App\Entity\EntityInterface;
use App\Entity\MainPageSlider;
use App\Model\MainPageSliderModel;
use App\Model\ModelInterface;
use App\Repository\MainPageSliderRepository;
use App\Service\CrudManager\CrudManager;
use App\Service\FileManager\FileManager;
use Doctrine\ORM\EntityManagerInterface;

class MainPageSliderService extends CrudManager
{
    private const IMG_UPLOAD_DIR = 'slider/';
    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * MainPageSliderService constructor.
     * @param  MainPageSliderRepository $repository
     * @param EntityManagerInterface $entityManager
     * @param MainPageSliderMapper $mapper
     * @param FileManager $fileManager
     */
    public function __construct(MainPageSliderRepository $repository, EntityManagerInterface $entityManager, MainPageSliderMapper $mapper, FileManager $fileManager)
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
                    var_dump($entity);
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