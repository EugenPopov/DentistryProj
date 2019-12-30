<?php


namespace App\Controller\Admin;


use App\DataMapper\PromotionMapper;
use App\Entity\Promotion;
use App\Form\PromotionForm;
use App\Model\PromotionModel;
use App\Service\PromotionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PromotionController extends AbstractController
{
    /**
     * @var PromotionService
     */
    private $service;
    /**
     * @var PromotionMapper
     */
    private $mapper;

    public function __construct(PromotionService $service, PromotionMapper $mapper)
    {
        $this->service = $service;
        $this->mapper = $mapper;
    }

    public function index()
    {
        return $this->render('admin/promotion/index.html.twig', [
            'promotions' => $this->service->findBy([], ['queue' => 'ASC'])
        ]);
    }

    public function create(Request $request)
    {
        $model = new PromotionModel();
        $form = $this->createForm(PromotionForm::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->create($data, new Promotion());
            return $this->redirectToRoute('promotion_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Добавление акции']);
    }

    public function update(Promotion $entity, Request $request)
    {
        $model = $this->mapper->entityToModel($entity);

        $form = $this->createForm(PromotionForm::class, $model, [
            'is_create' => false, 'image' => $entity->getImage()
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->update($data, $entity);
            return $this->redirectToRoute('promotion_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Редактирование акции']);
    }

    public function updateQueue(Request $request)
    {
        $array = $request->get('queue');
        $this->service->updateQueue($array);
        return new Response(null, Response::HTTP_OK);
    }

    public function updateActive(Request $request)
    {
        $active = $request->request->getBoolean('active');
        $id = $request->request->getInt('id');
        $this->service->updateActive($id, $active);
        return new Response(null, Response::HTTP_OK);
    }

    public function updatePublic(Request $request)
    {
        $active = $request->request->getBoolean('active');
        $id = $request->request->getInt('id');
        $this->service->updatePublic($id, $active);
        return new Response(null, Response::HTTP_OK);
    }

    public function delete(Promotion $entity)
    {
        $this->service->delete($entity);
        return $this->redirectToRoute('promotion_index');
    }
}