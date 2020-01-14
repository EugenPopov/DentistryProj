<?php


namespace App\Controller\Pages;


use App\Service\PromotionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PromotionsController extends AbstractController
{
    /**
     * @var PromotionService
     */
    private $promotionService;

    /**
     * PromotionsController constructor.
     * @param PromotionService $promotionService
     */
    public function __construct(PromotionService $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    public function index()
    {
        return $this->render('public/promotions.html.twig', [
            'promotions' => $this->promotionService->findBy(['is_public' => true, 'is_active' => true], ['queue' => 'ASC'])
        ]);
    }
}
