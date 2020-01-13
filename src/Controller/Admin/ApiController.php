<?php


namespace App\Controller\Admin;


use App\Service\ApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
    /**
     * @var ApplicationService
     */
    private $applicationService;

    /**
     * ApiController constructor.
     * @param ApplicationService $applicationService
     */
    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }


    public function getNewApplicationsAmount()
    {
        return new JsonResponse($this->applicationService->getNewApplicationsAmount());
    }
}