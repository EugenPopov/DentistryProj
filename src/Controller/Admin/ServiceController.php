<?php


namespace App\Controller\Admin;


use App\DataMapper\MainPageSliderMapper;
use App\DataMapper\ServiceMapper;
use App\Entity\Service;
use App\Form\ServiceForm;
use App\Model\ServiceModel;
use App\Service\MainPageSliderService;
use App\Service\MiniServiceService;
use App\Service\ServiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends AbstractController
{

    /**
     * @var MainPageSliderService
     */
    private $service;
    /**
     * @var MainPageSliderMapper
     */
    private $mapper;
    /**
     * @var MiniServiceService
     */
    private $miniServiceService;
    /**
     * @var ServiceService
     */
    private $serviceService;


    /**
     * MainPageSliderController constructor.
     * @param ServiceService $service
     * @param ServiceMapper $mapper
     * @param MiniServiceService $miniServiceService
     * @param ServiceService $serviceService
     */
    public function __construct(ServiceService $service, ServiceMapper $mapper, MiniServiceService $miniServiceService, ServiceService $serviceService)
    {
        $this->service = $service;
        $this->mapper = $mapper;
        $this->miniServiceService = $miniServiceService;
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        return $this->render('admin/service/index.html.twig', [
            'services' => $this->service->findBy([], ['queue' => 'ASC'])
        ]);
    }

    public function create(Request $request)
    {
        $model = new ServiceModel();
        $model->setMiniServices($this->miniServiceService->getAllInJson());
        $form = $this->createForm(ServiceForm::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->create($data, new Service());
            return $this->redirectToRoute('service_index');
        }

        return $this->render('admin/service/create.html.twig', ['form' => $form->createView(), 'name' => 'Добавление услуги']);
    }

    public function update(Service $entity, Request $request)
    {
        $model = $this->mapper->entityToModel($entity);

        $form = $this->createForm(ServiceForm::class, $model, [
            'is_create' => false,
            'image' => $entity->getImage(),
            'icon' => $entity->getIcon()
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->update($data, $entity);
            return $this->redirectToRoute('service_index');
        }

        return $this->render('admin/service/update.html.twig', [
            'form' => $form->createView(),
            'services' => $this->miniServiceService->getAllInJson(),
            'name' => 'Редактирование услуги "'.$entity->getTitle().'"'
        ]);
    }

    public function updateQueue(Request $request)
    {
        $array = $request->get('queue');
        $this->service->updateQueue($array);
        return new Response(null, Response::HTTP_OK);
    }

    public function delete(Service $entity)
    {
        $this->service->delete($entity);
        return $this->redirectToRoute('service_index');
    }
}