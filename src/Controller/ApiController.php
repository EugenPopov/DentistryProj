<?php


namespace App\Controller;


use App\Service\OrderService;
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
     * @var OrderService
     */
    private $orderService;

    /**
     * ApiController constructor.
     * @param PromotionService $promotionService
     * @param OrderService $orderService
     */
    public function __construct(PromotionService $promotionService, OrderService $orderService)
    {
        $this->promotionService = $promotionService;
        $this->orderService = $orderService;
    }

    public function checkPromotion(Request $request)
    {

        $promotion = $this->promotionService->findOneBy(['code' => $request->get('promotion'), 'is_active' => true]);
        return new JsonResponse(['exists' => $promotion? $promotion->getTitle():false], Response::HTTP_OK);
    }

    public function submitApplication(Request $request)
    {
        $name = $request->get('name');
        $phone = $request->get('telephone');
        $date = $request->get('date');
        $time = $request->get('time');
        $comment = $request->get('comment');
        $promotion = $request->get('promotion');
        $this->orderService->makeOrder($name, $phone, $date, $time, $comment, $promotion);

        return new JsonResponse($request->request->all());
    }
}