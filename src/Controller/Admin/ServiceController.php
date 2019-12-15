<?php


namespace App\Controller\Admin;


use App\DataMapper\MainPageSliderMapper;
use App\DataMapper\ServiceMapper;
use App\Entity\Service;
use App\Form\ServiceForm;
use App\Model\ServiceModel;
use App\Service\MainPageSliderService;
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
     * MainPageSliderController constructor.
     * @param ServiceService $service
     * @param ServiceMapper $mapper
     */
    public function __construct(ServiceService $service, ServiceMapper $mapper)
    {
        $this->service = $service;
        $this->mapper = $mapper;
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
        $form = $this->createForm(ServiceForm::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->create($data, new Service());
            return $this->redirectToRoute('service_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Добавление услуги']);
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

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Редактирование услуги "'.$entity->getTitle().'"']);
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