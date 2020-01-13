<?php


namespace App\Controller\Admin;


use App\DataMapper\DoctorMapper;
use App\Entity\Doctor;
use App\Form\DoctorForm;
use App\Model\DoctorModel;
use App\Service\DoctorService;
use App\Service\MainPageSliderService;
use App\Service\ServiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorController extends AbstractController
{
    /**
     * @var MainPageSliderService
     */
    private $service;
    /**
     * @var DoctorMapper
     */
    private $mapper;
    /**
     * @var ServiceService
     */
    private $serviceService;


    /**
     * MainPageSliderController constructor.
     * @param DoctorService $service
     * @param DoctorMapper $mapper
     * @param ServiceService $serviceService
     */
    public function __construct(DoctorService $service, DoctorMapper $mapper, ServiceService $serviceService)
    {
        $this->service = $service;
        $this->mapper = $mapper;
        $this->serviceService = $serviceService;
    }

    public function index()
    {
        return $this->render('admin/doctor/index.html.twig', [
            'doctors' => $this->service->findBy([], ['queue' => 'ASC'])
        ]);
    }

    public function create(Request $request)
    {
        $model = new DoctorModel();
        $model->setServices($this->serviceService->getAllInJson());
        $form = $this->createForm(DoctorForm::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->create($data, new Doctor());
            return $this->redirectToRoute('doctor_index');
        }

        return $this->render('admin/doctor/create.html.twig', [
            'form' => $form->createView(),
            'name' => 'Добавление врача'
        ]);
    }

    public function update(Doctor $entity, Request $request)
    {
        $model = $this->mapper->entityToModel($entity);

        $form = $this->createForm(DoctorForm::class, $model, [
            'is_create' => false, 'image' => $entity->getImage()
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->update($data, $entity);
            return $this->redirectToRoute('doctor_index');
        }

        return $this->render('admin/doctor/update.html.twig', [
            'form' => $form->createView(),
            'services' => $this->serviceService->getAllInJson(),
            'name' => 'Редактирование врача'
        ]);
    }

    public function updateQueue(Request $request)
    {
        $array = $request->get('queue');
        $this->service->updateQueue($array);
        return new Response(null, Response::HTTP_OK);
    }

    public function delete(Doctor $entity)
    {
        $this->service->delete($entity);
        return $this->redirectToRoute('doctor_index');
    }
}