<?php


namespace App\Controller\Pages;


use App\Service\BlogService;
use App\Service\PromotionService;
use App\Service\ReviewService;
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
     * @var PromotionService
     */
    private $promotionService;

    /**
     * ReviewController constructor.
     * @param ReviewService $reviewService
     * @param BlogService $blogService
     * @param PromotionService $promotionService
     */
    public function __construct(ReviewService $reviewService, BlogService $blogService, PromotionService $promotionService)
    {
        $this->reviewService = $reviewService;
        $this->blogService = $blogService;
        $this->promotionService = $promotionService;
    }

    public function index()
    {
        return $this->render('public/reviews.html.twig', [
            'reviews' => $this->reviewService->getInArray(),
            'articles' => $this->blogService->findBy([], ['queue' => 'ASC']),
            'promotions' => $this->promotionService->findBy(['is_active' => true, 'is_public' => true], ['queue' => 'ASC'], 3)
        ]);
    }

    public function singlePost()
    {
    }
}
