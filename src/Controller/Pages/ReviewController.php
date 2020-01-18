<?php


namespace App\Controller\Pages;


use App\Service\BlogService;
use App\Service\PromotionService;
use App\Service\ReviewService;
use App\Service\WorksGalleryService;
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
     * @var WorksGalleryService
     */
    private $galleryService;

    /**
     * ReviewController constructor.
     * @param ReviewService $reviewService
     * @param BlogService $blogService
     * @param PromotionService $promotionService
     * @param WorksGalleryService $galleryService
     */
    public function __construct(ReviewService $reviewService, BlogService $blogService, PromotionService $promotionService, WorksGalleryService $galleryService)
    {
        $this->reviewService = $reviewService;
        $this->blogService = $blogService;
        $this->promotionService = $promotionService;
        $this->galleryService = $galleryService;
    }

    public function index()
    {
        return $this->render('public/reviews.html.twig', [
            'reviews' => $this->reviewService->getInArray(),
            'articles' => $this->blogService->findBy([], ['queue' => 'ASC']),
            'promotions' => $this->promotionService->findBy(['is_active' => true, 'is_public' => true], ['queue' => 'ASC'], 3),
            'gallery' => $this->galleryService->findBy([], ['queue' => 'ASC'])
        ]);
    }

    public function singlePost()
    {
        return $this->render('public/single_post.html.twig');
    }
}
