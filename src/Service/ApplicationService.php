<?php


namespace App\Service;


use App\Entity\Application;
use App\Repository\ApplicationRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class ApplicationService
{
    /**
     * @var ApplicationRepository
     */
    private $applicationRepository;
    /**
     * @var PromotionService
     */
    private $promotionService;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * OrderService constructor.
     * @param ApplicationRepository $applicationRepository
     * @param PromotionService $promotionService
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ApplicationRepository $applicationRepository, PromotionService $promotionService, EntityManagerInterface $entityManager)
    {
        $this->applicationRepository = $applicationRepository;
        $this->promotionService = $promotionService;
        $this->entityManager = $entityManager;
    }

    public function makeOrder(string $name, string $phone, string $date, string $time, string $comment, $promotion)
    {
        try {
            $date = $date ? new DateTime($date . ' ' . $time) : null;
        } catch (\Exception $e) {
            $date = null;
        }

        $promotion = $this->promotionService->findOneBy(['code' => $promotion]);

        $application = new Application();
        $application->setName($name)
            ->setPhone($phone)
            ->setDate($date)
            ->setComment($comment)
            ->setPromotion($promotion);

        $this->entityManager->persist($application);
        $this->entityManager->flush();

        return $application;
    }
}