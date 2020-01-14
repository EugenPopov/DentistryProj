<?php


namespace App\Controller\Pages;


use App\Entity\Review;
use App\Service\BlogService;
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
     * @var BlogService
     */
    private $blogService;

    /**
     * ReviewController constructor.
     * @param ReviewService $reviewService
     * @param BlogService $blogService
     */
    public function __construct(ReviewService $reviewService, BlogService $blogService)
    {
        $this->reviewService = $reviewService;
        $this->blogService = $blogService;
    }

    public function index()
    {
        return $this->render('public/reviews.html.twig', [
            'reviews' => $this->reviewService->findBy([],['queue' => 'ASC']),
            'articles' => $this->blogService->findBy([], ['queue' => 'ASC'])
        ]);
    }
}
