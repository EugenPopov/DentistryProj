<?php


namespace App\Service\CrudManager;


use App\DataMapper\DataMapperInterface;
use App\Entity\EntityInterface;
use App\Model\ModelInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;

abstract class CrudManager implements CrudManagerInterface
{

    protected $repository;
    protected $entityManager;
    protected $mapper;

    public function __construct(ServiceEntityRepository $repository, EntityManagerInterface $entityManager, DataMapperInterface $mapper)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->mapper = $mapper;
    }

    public function all():iterable
    {
        return $this->repository->findAll();
    }

    public function item(string $slug): ?object
    {
        return $this->repository->findOneBy(['slug' => $slug]);
    }

    public function findBy(array $parameters = [], array $order = [], int $limit = null)
    {
        return $this->repository->findBy($parameters, $order, $limit);
    }

    public function findOneBy(array $parameters = [], array $order = [])
    {
        return $this->repository->findOneBy($parameters, $order);
    }

    public function create(ModelInterface $model, EntityInterface $entity)
    {
        $article  = $this->mapper->modelToEntity($model,  $entity);

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        return $article;
    }

    public function update(ModelInterface $model , EntityInterface $entity)
    {
        $article = $this->mapper->modelToEntity($model, $entity);
        $this->entityManager->flush();

        return $article;
    }

    public function delete(EntityInterface $entity): void
    {
        if ($entity) {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();
        }
    }
}
