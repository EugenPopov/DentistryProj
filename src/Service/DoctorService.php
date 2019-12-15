<?php


namespace App\Service;


use App\DataMapper\DoctorMapper;
use App\Entity\Doctor;
use App\Entity\EntityInterface;
use App\Model\DoctorModel;
use App\Model\ModelInterface;
use App\Repository\DoctorRepository;
use App\Repository\ServiceRepository;
use App\Service\CrudManager\CrudManager;
use App\Service\FileManager\FileManager;
use Doctrine\ORM\EntityManagerInterface;

class DoctorService extends CrudManager
{
    private const IMG_UPLOAD_DIR = 'doctor/';
    /**
     * @var FileManager
     */
    private $fileManager;
    /**
     * @var ServiceRepository
     */
    private $serviceRepository;

    /**
     * MainPageSliderService constructor.
     * @param DoctorRepository $repository
     * @param EntityManagerInterface $entityManager
     * @param DoctorMapper $mapper
     * @param FileManager $fileManager
     * @param ServiceRepository $serviceRepository
     */
    public function __construct(DoctorRepository $repository, EntityManagerInterface $entityManager, DoctorMapper $mapper, FileManager $fileManager, ServiceRepository $serviceRepository)
    {
        parent::__construct($repository ,$entityManager, $mapper);
        $this->fileManager = $fileManager;
        $this->serviceRepository = $serviceRepository;
        $this->repository = $repository;
    }

    public function create(ModelInterface $model, EntityInterface $entity)
    {
        /** @var DoctorModel $model */
        /** @var Doctor $entity */
        $entity = $this->mapper->modelToEntity($model, $entity);
        $entity->setQueue($this->getLastQueue());

        $uploadedFile = $this->fileManager->uploadFile($model->getImage(), self::IMG_UPLOAD_DIR);
        $entity->setImage(self::IMG_UPLOAD_DIR . $uploadedFile);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        if($services = json_decode($model->getServices(), true)){
            foreach ($services as $service) {
                if($service_found = $this->serviceRepository->find($service)){
                    $entity->addService($service_found);
                }
            }
        }
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

    public function update(ModelInterface $model , EntityInterface $entity)
    {
        /** @var DoctorModel $model */
        /** @var Doctor $entity */
        $entity = $this->mapper->modelToEntity($model, $entity);

        foreach ($entity->getServices() as $service) {
            $entity->removeService($service);
        }

        if($services = json_decode($model->getServices(), true)){
            foreach ($services as $service) {
                if($service_found = $this->serviceRepository->find($service)){
                    $entity->addService($service_found);
                }
            }
        }

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
        /** @var Doctor $entity */
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