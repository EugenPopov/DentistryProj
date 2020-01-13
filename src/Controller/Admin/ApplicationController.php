<?php


namespace App\Controller\Admin;


use App\Entity\Application;
use App\Service\ApplicationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    public function index()
    {
        return $this->render('admin/application/index.html.twig', [
            'applications' => $this->applicationService->findBy([], ['is_new' => 'DESC', 'created_at' => 'DESC'])
        ]);
    }

    public function updateIsNew(Application $application)
    {
        $application->setIsNew(!$application->getIsNew());
        $this->entityManager->flush();
        return $this->redirectToRoute('application_index');
    }
}