<?php


namespace App\Controller\Admin;


use App\Entity\Application;
use App\Service\ApplicationService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ApplicationController extends AbstractController
{
    /**
     * @var ApplicationService
     */
    private $applicationService;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * ApplicationController constructor.
     * @param ApplicationService $applicationService
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ApplicationService $applicationService, EntityManagerInterface $entityManager)
    {
        $this->applicationService = $applicationService;
        $this->entityManager = $entityManager;
    }

    public function index(Request $request, PaginatorInterface $paginator)
    {
        $applications = $paginator->paginate(
            $this->applicationService->getSearchQuery(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('admin/application/index.html.twig', [
            'applications' => $applications
        ]);
    }

    public function removeOld()
    {
        $this->applicationService->removeOld();
        return $this->redirectToRoute('application_index');
    }

    public function updateIsNew(Application $application)
    {
        $application->setIsNew(!$application->getIsNew());
        $this->entityManager->flush();
        return $this->redirectToRoute('application_index');
    }
}