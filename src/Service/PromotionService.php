<?php


namespace App\Service;


use App\DataMapper\PromotionMapper;
use App\Entity\EntityInterface;
use App\Entity\Promotion;
use App\Model\ModelInterface;
use App\Model\PromotionModel;
use App\Repository\PromotionRepository;
use App\Service\CrudManager\CrudManager;
use App\Service\FileManager\FileManager;
use Doctrine\ORM\EntityManagerInterface;

class PromotionService  extends CrudManager
{
    private const IMG_UPLOAD_DIR = 'promotion/';
    /**
     * @var FileManager
     */
    private $fileManager;

    public function __construct(PromotionRepository $repository, EntityManagerInterface $entityManager, PromotionMapper $mapper, FileManager $fileManager)
    {
        parent::__construct($repository ,$entityManager, $mapper);
        $this->fileManager = $fileManager;
        $this->repository = $repository;
    }

    public function create(ModelInterface $model, EntityInterface $entity)
    {
        /** @var PromotionModel $model */
        /** @var Promotion $entity */
        $entity = $this->mapper->modelToEntity($model, $entity);
        $entity->setQueue($this->getLastQueue());
        $entity->setCode($this->generateRandomString());

        $uploadedFile = $this->fileManager->uploadFile($model->getImage(), self::IMG_UPLOAD_DIR);
        $entity->setImage(self::IMG_UPLOAD_DIR . $uploadedFile);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function update(ModelInterface $model , EntityInterface $entity)
    {
        /** @var PromotionModel $model */
        /** @var Promotion $entity */
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
        /** @var Promotion $entity */
        $this->fileManager->deleteFile($entity->getImage());
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }

    private function getLastQueue(): int
    {
        $queue = $this->repository->getLastQueue();

        return $queue ? $queue->getQueue()+1:0;
    }

    private  function generateRandomString($length = 10, $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function updateActive(int $id, bool $active): void
    {
        if($promotion = $this->repository->find($id)){
            $promotion->setIsActive($active);
            $this->entityManager->flush();
        }
    }

    public function updatePublic(int $id, bool $active): void
    {
        if($promotion = $this->repository->find($id)){
            $promotion->setIsPublic($active);
            $this->entityManager->flush();
        }
    }
}