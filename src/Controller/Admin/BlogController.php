<?php


namespace App\Controller\Admin;


use App\DataMapper\BlogMapper;
use App\DataMapper\MainPageSliderMapper;
use App\DataMapper\SertificateMapper;
use App\Entity\Blog;
use App\Entity\Sertificate;
use App\Form\BlogForm;
use App\Form\SertificateForm;
use App\Model\BlogModel;
use App\Model\SertificateModel;
use App\Service\BlogService;
use App\Service\MainPageSliderService;
use App\Service\SertificateService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    /**
     * @var BlogService
     */
    private $service;
    /**
     * @var BlogMapper
     */
    private $mapper;

    /**
     * MainPageSliderController constructor.
     * @param BlogService $service
     * @param BlogMapper $mapper
     */
    public function __construct(BlogService $service, BlogMapper $mapper)
    {
        $this->service = $service;
        $this->mapper = $mapper;
    }

    public function index()
    {
        return $this->render('admin/blog/index.html.twig', [
            'articles' => $this->service->findBy([], ['queue' => 'ASC'])
        ]);
    }

    public function create(Request $request)
    {
        $model = new BlogModel();
        $form = $this->createForm(BlogForm::class, $model);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->create($data, new Blog());
            return $this->redirectToRoute('blog_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Добавление статьи']);
    }

    public function update(Blog $entity, Request $request)
    {
        $model = $this->mapper->entityToModel($entity);

        $form = $this->createForm(BlogForm::class, $model, [
            'is_create' => false, 'image' => $entity->getImage()
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $this->service->update($data, $entity);
            return $this->redirectToRoute('blog_index');
        }

        return $this->render('admin/form.html.twig', ['form' => $form->createView(), 'name' => 'Редактирование статьи']);
    }

    public function updateQueue(Request $request)
    {
        $array = $request->get('queue');
        $this->service->updateQueue($array);
        return new Response(null, Response::HTTP_OK);
    }

    public function delete(Blog $entity)
    {
        $this->service->delete($entity);
        return $this->redirectToRoute('blog_index');
    }
}