<?php


namespace App\Service;


use App\Entity\Application;
use App\Repository\ApplicationRepository;
use App\Service\MailSender\MailSender;
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
     * @var MailSender
     */
    private $mailSender;

    /**
     * OrderService constructor.
     * @param ApplicationRepository $applicationRepository
     * @param PromotionService $promotionService
     * @param EntityManagerInterface $entityManager
     * @param MailSender $mailSender
     */
    public function __construct(
        ApplicationRepository $applicationRepository,
        PromotionService $promotionService,
        EntityManagerInterface $entityManager,
        MailSender $mailSender
    )
    {
        $this->applicationRepository = $applicationRepository;
        $this->promotionService = $promotionService;
        $this->entityManager = $entityManager;
        $this->mailSender = $mailSender;
    }

    public function create(string $name, string $phone, string $date, string $time, string $comment, $promotion, bool $notify = false)
    {
        try {
            $date = $date ? new DateTime($date . ' ' . $time) : null;
        } catch (\Exception $e) {
            $date = null;
        }

        $promotion = $this->promotionService->findOneBy(['code' => $promotion, 'is_active' => true]);

        $application = new Application();
        $application->setName($name)
            ->setCreatedAt(new DateTime())
            ->setPhone($phone)
            ->setDate($date)
            ->setComment($comment)
            ->setIsNew(true)
            ->setPromotion($promotion);

        $this->entityManager->persist($application);
        $this->entityManager->flush();

        if($notify){
            $this->mailSender->sendNotification($application);
        }

        return $application;
    }

    public function getNewApplicationsAmount(): int
    {
        $amount = $this->applicationRepository->getNewApplicationsAmount();
        $amount = $amount['1'] ?? 0;
        return $amount;
    }

    public function all()
    {
        return $this->applicationRepository->findAll();
    }

    public function findBy(array $parameters = [], array $order = [], int $limit = null)
    {
        return $this->applicationRepository->findBy($parameters, $order, $limit);
    }

    public function getSearchQuery()
    {
        return $this->applicationRepository->getSearchQuery();
    }

    public function removeOld(): void
    {
        $applications = $this->applicationRepository->findBy(['is_new' => false]);
        foreach ($applications as $application) {
            $this->entityManager->remove($application);
        }
        $this->entityManager->flush();
    }
}