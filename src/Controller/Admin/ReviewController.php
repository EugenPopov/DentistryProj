<?php

namespace App\Controller\Admin;

use App\DataMapper\ReviewMapper;
use App\Entity\Review;
use App\Form\ReviewForm;
use App\Model\ReviewModel;
use App\Service\ReviewService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends AbstractController
{
    /**
     * @var ReviewService
     */
    private $service;
    /**
     * @var ReviewMapper
     */
    private $mapper;

    public function __construct(ReviewService $service, ReviewMapper $mapper)
    {
        $this->service = $service;
        $this->mapper = $mapper;
    }

    public function index()
    {
        return $this->render('admin/review/index.html.twig', [
            'reviews' => $this->service->findBy([], ['queue' => 'ASC'])
        ]);
    }

    public function create(Request $request)
    {
        $model = new ReviewModel();
        $form = $this->createForm(ReviewForm::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->create($data, new Review());
            return $this->redirectToRoute('review_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Добавление отзыва']);
    }

    public function update(Review $entity, Request $request)
    {
        $model = $this->mapper->entityToModel($entity);

        $form = $this->createForm(ReviewForm::class, $model, [
            'is_create' => false, 'image' => $entity->getImage()
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->update($data, $entity);
            return $this->redirectToRoute('review_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Редактирование отзыва']);
    }

    public function updateQueue(Request $request)
    {
        $array = $request->get('queue');
        $this->service->updateQueue($array);
        return new Response(null, Response::HTTP_OK);
    }

    public function delete(Review $entity)
    {
        $this->service->delete($entity);
        return $this->redirectToRoute('review_index');
    }
}