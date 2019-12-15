<?php


namespace App\Controller\Admin;


use App\DataMapper\MainPageSliderMapper;
use App\DataMapper\SertificateMapper;
use App\Entity\Sertificate;
use App\Form\SertificateForm;
use App\Model\SertificateModel;
use App\Service\MainPageSliderService;
use App\Service\SertificateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SertificateController extends AbstractController
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
     * @param SertificateService $service
     * @param SertificateMapper $mapper
     */
    public function __construct(SertificateService $service, SertificateMapper $mapper)
    {
        $this->service = $service;
        $this->mapper = $mapper;
    }

    public function index()
    {
        return $this->render('admin/sertificate/index.html.twig', [
            'sertificates' => $this->service->findBy([], ['queue' => 'ASC'])
        ]);
    }

    public function create(Request $request)
    {
        $model = new SertificateModel();
        $form = $this->createForm(SertificateForm::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->create($data, new Sertificate());
            return $this->redirectToRoute('sertificate_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Добавление сертификата']);
    }

    public function update(Sertificate $entity, Request $request)
    {
        $model = $this->mapper->entityToModel($entity);

        $form = $this->createForm(SertificateForm::class, $model, [
            'is_create' => false, 'image' => $entity->getImage()
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->update($data, $entity);
            return $this->redirectToRoute('sertificate_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Редактирование слайда']);
    }

    public function updateQueue(Request $request)
    {
        $array = $request->get('queue');
        $this->service->updateQueue($array);
        return new Response(null, Response::HTTP_OK);
    }

    public function delete(Sertificate $entity)
    {
        $this->service->delete($entity);
        return $this->redirectToRoute('sertificate_index');
    }
}