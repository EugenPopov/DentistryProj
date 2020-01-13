<?php


namespace App\Controller\Admin;


use App\DataMapper\WorksGalleryMapper;
use App\Entity\WorksGallery;
use App\Form\WorksGalleryForm;
use App\Model\WorksGalleryModel;
use App\Service\WorksGalleryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WorksGalleryController extends AbstractController
{
    /**
     * @var WorksGalleryService
     */
    private $service;
    /**
     * @var WorksGalleryMapper
     */
    private $mapper;

    /**
     * MainPageSliderController constructor.
     * @param WorksGalleryService $service
     * @param WorksGalleryMapper $mapper
     */
    public function __construct(WorksGalleryService $service, WorksGalleryMapper $mapper)
    {
        $this->service = $service;
        $this->mapper = $mapper;
    }

    public function index()
    {
        return $this->render('admin/works_gallery/index.html.twig', [
            'works' => $this->service->findBy([], ['queue' => 'ASC'])
        ]);
    }

    public function create(Request $request)
    {
        $model = new WorksGalleryModel();
        $form = $this->createForm(WorksGalleryForm::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->create($data, new WorksGallery());
            return $this->redirectToRoute('gallery_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Добавление работы']);
    }

    public function update(WorksGallery $entity, Request $request)
    {
        $model = $this->mapper->entityToModel($entity);

        $form = $this->createForm(WorksGalleryForm::class, $model, [
            'is_create' => false, 'image' => $entity->getImage()
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->update($data, $entity);
            return $this->redirectToRoute('gallery_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Редактирование работы']);
    }

    public function updateQueue(Request $request)
    {
        $array = $request->get('queue');
        $this->service->updateQueue($array);
        return new Response(null, Response::HTTP_OK);
    }

    public function delete(WorksGallery $entity)
    {
        $this->service->delete($entity);
        return $this->redirectToRoute('gallery_index');
    }
}