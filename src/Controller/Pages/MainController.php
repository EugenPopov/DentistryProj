<?php


namespace App\Controller\Pages;


use App\Service\CommonSettings\CommonSettingsInterface;
use App\Service\DoctorService;
use App\Service\MailSender\MailSender;
use App\Service\MainPageSliderService;
use App\Service\ReviewService;
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
     * @var ReviewService
     */
    private $reviewService;

    /**
     * MainController constructor.
     * @param MainPageSliderService $mainPageSliderService
     * @param ServiceService $serviceService
     * @param DoctorService $doctorService
     * @param CommonSettingsInterface $commonSettings
     * @param ReviewService $reviewService
     */
    public function __construct(
        MainPageSliderService $mainPageSliderService,
        ServiceService $serviceService,
        DoctorService $doctorService, CommonSettingsInterface $commonSettings,
        ReviewService $reviewService
    )
    {
        $this->mainPageSliderService = $mainPageSliderService;
        $this->serviceService = $serviceService;
        $this->doctorService = $doctorService;
        $this->commonSettings = $commonSettings;
        $this->reviewService = $reviewService;
    }

    public function index()
    {
        return $this->render('public/index_page.html.twig', [
            'slides' => $this->mainPageSliderService->findBy([], ['queue' => 'ASC']),
            'services' => $this->serviceService->findBy([], ['queue' => 'ASC']),
            'doctors' => $this->doctorService->findBy([], ['queue' => 'ASC']),
            'reviews' => $this->reviewService->findBy([], ['queue' => 'ASC'])
        ]);
    }

    public function showContacts()
    {
        return $this->render('public/contacts.html.twig');
    }
}
