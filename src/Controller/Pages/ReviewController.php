<?php


namespace App\Controller\Pages;


use App\Entity\Review;
use App\Service\ReviewService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewController extends AbstractController
{
    /**
     * @var ReviewService
     */
    private $reviewService;

    /**
     * ReviewController constructor.
     * @param ReviewService $reviewService
     */
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function index()
    {
        return $this->render('public/reviews.html.twig', [
            'reviews' => $this->reviewService->findBy([],['queue' => 'ASC'])
        ]);
    }
}
