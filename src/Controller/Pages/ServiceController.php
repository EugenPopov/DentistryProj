<?php


namespace App\Controller\Pages;


use App\Entity\Service;
use App\Service\ServiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController extends AbstractController
{
    /**
     * @var ServiceService
     */
    private $service;

    /**
     * ServiceController constructor.
     * @param ServiceService $service
     */
    public function __construct(ServiceService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->render('public/services/index.html.twig', [
            'services' => $this->service->all()
        ]);
    }

    public function singleService(Service $service)
    {
        return $this->render('public/services/single.html.twig', [
            'service' => $this->service->getServiceWithSubServices($service)
        ]);
    }
}
