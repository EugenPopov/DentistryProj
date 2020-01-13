<?php


namespace App\Controller;


use App\Service\PromotionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends AbstractController
{
    /**
     * @var PromotionService
     */
    private $promotionService;

    /**
     * ApiController constructor.
     * @param PromotionService $promotionService
     */
    public function __construct(PromotionService $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    public function checkPromotion(Request $request)
    {
        $promotion = $this->promotionService->findOneBy(['code' => $request->get('promotion')]);
        return new JsonResponse(['exists' => $promotion? $promotion->getTitle():false], Response::HTTP_OK);
    }
}