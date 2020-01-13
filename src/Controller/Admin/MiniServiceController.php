<?php


namespace App\Controller\Admin;


use App\DataMapper\MiniServiceMapper;
use App\Entity\MiniService;
use App\Form\MiniServiceForm;
use App\Model\MiniServiceModel;
use App\Service\MiniServiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MiniServiceController extends AbstractController
{
    /**
     * @var MiniServiceService
     */
    private $service;
    /**
     * @var MiniServiceMapper
     */
    private $mapper;


    /**
     * @param MiniServiceService $service
     * @param MiniServiceMapper $mapper
     */
    public function __construct(MiniServiceService $service, MiniServiceMapper $mapper)
    {
        $this->service = $service;
        $this->mapper = $mapper;
    }

    public function apiCreate(Request $request)
    {
        $title = $request->get('title');
        $price = $request->get('price');
        $model = $this->mapper->fieldsToModel($title, $price);
        $entity = $this->service->createAndReturn($model);

        return $this->json($entity);
    }

    public function index()
    {
        return $this->render('admin/mini_service/index.html.twig', [
            'mini_services' => $this->service->findBy([], ['id' => 'ASC'])
        ]);
    }

    public function create(Request $request)
    {
        $model = new MiniServiceModel();
        $form = $this->createForm(MiniServiceForm::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->create($data, new MiniService());
            return $this->redirectToRoute('mini_service_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Добавление слайда']);
    }

    public function update(MiniService $entity, Request $request)
    {
        $model = $this->mapper->entityToModel($entity);

        $form = $this->createForm(MiniServiceForm::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->update($data, $entity);
            return $this->redirectToRoute('mini_service_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Редактирование слайда']);
    }

    public function delete(MiniService $entity)
    {
        $this->service->delete($entity);
        return $this->redirectToRoute('mini_service_index');
    }
}