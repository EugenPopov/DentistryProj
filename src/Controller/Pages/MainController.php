<?php


namespace App\Controller\Pages;


use App\Service\CommonSettings\CommonSettingsInterface;
use App\Service\DoctorService;
use App\Service\MainPageSliderService;
use App\Service\ServiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @var MainPageSliderService
     */
    private $mainPageSliderService;
    /**
     * @var ServiceService
     */
    private $serviceService;
    /**
     * @var DoctorService
     */
    private $doctorService;
    /**
     * @var CommonSettingsInterface
     */
    private $commonSettings;

    /**
     * MainController constructor.
     * @param MainPageSliderService $mainPageSliderService
     * @param ServiceService $serviceService
     * @param DoctorService $doctorService
     * @param CommonSettingsInterface $commonSettings
     */
    public function __construct(
        MainPageSliderService $mainPageSliderService,
        ServiceService $serviceService,
        DoctorService $doctorService, CommonSettingsInterface $commonSettings)
    {
        $this->mainPageSliderService = $mainPageSliderService;
        $this->serviceService = $serviceService;
        $this->doctorService = $doctorService;
        $this->commonSettings = $commonSettings;
    }

    public function index()
    {
        return $this->render('public/index_page.html.twig', [
            'slides' => $this->mainPageSliderService->findBy([], ['queue' => 'ASC']),
            'services' => $this->serviceService->findBy([], ['queue' => 'ASC']),
            'doctors' => $this->doctorService->findBy([], ['queue' => 'ASC'])
        ]);
    }
}
