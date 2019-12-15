<?php


namespace App\Controller\Admin;


use App\DataMapper\MainPageSliderMapper;
use App\Entity\MainPageSlider;
use App\Form\MainPageSliderForm;
use App\Model\MainPageSliderModel;
use App\Service\Assert\RussianConstraint;
use App\Service\Assert\RussianNotBlank;
use App\Service\MainPageSliderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;

class MainPageSliderController extends AbstractController
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
     * @param MainPageSliderService $service
     * @param MainPageSliderMapper $mapper
     */
    public function __construct(MainPageSliderService $service, MainPageSliderMapper $mapper)
    {
        $this->service = $service;
        $this->mapper = $mapper;
    }

    public function index()
    {
        return $this->render('admin/main_page_slider/index.html.twig', [
            'slides' => $this->service->findBy([], ['queue' => 'ASC'])
        ]);
    }

    public function create(Request $request)
    {
        $model = new MainPageSliderModel();
        $form = $this->createForm(MainPageSliderForm::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->create($data, new MainPageSlider());
            return $this->redirectToRoute('main_page_slider_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Добавление слайда']);
    }

    public function update(MainPageSlider $entity, Request $request)
    {
        $model = $this->mapper->entityToModel($entity);

        $form = $this->createForm(MainPageSliderForm::class, $model, [
            'is_create' => false, 'image' => $entity->getImage()
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->update($data, $entity);
            return $this->redirectToRoute('main_page_slider_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Редактирование слайда']);
    }

    public function updateQueue(Request $request)
    {
        $array = $request->get('queue');
        $this->service->updateQueue($array);
        return new Response(null, Response::HTTP_OK);
    }

    public function delete(MainPageSlider $entity)
    {
        $this->service->delete($entity);
        return $this->redirectToRoute('main_page_slider_index');
    }
}