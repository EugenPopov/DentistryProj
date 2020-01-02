<?php


namespace App\Controller\Pages;


use App\Entity\Doctor;
use App\Service\CommonSettings\CommonSettingsInterface;
use App\Service\DoctorService;
use App\Service\MainPageSliderService;
use App\Service\ReviewService;
use App\Service\ServiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DoctorController extends AbstractController
{
    /**
     * @var DoctorService
     */
    private $doctorService;

    /**
     * MainController constructor.
     * @param DoctorService $doctorService
     */
    public function __construct(
        DoctorService $doctorService
    )
    {
        $this->doctorService = $doctorService;
    }

    public function index()
    {
        return $this->render('public/doctors/index.html.twig',[
            'doctors' => $this->doctorService->findBy([], ['queue' => 'ASC'])]);
    }

    public function singleDoctor($slug)
    {
    }
}
