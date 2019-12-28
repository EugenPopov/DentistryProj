<?php


namespace App;


use App\Service\CommonSettings\CommonSettingsInterface;
use App\Service\ServiceService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    /**
     * @var ServiceService
     */
    private $serviceService;
    /**
     * @var CommonSettingsInterface
     */
    private $commonSettings;

    /**
     * AppExtension constructor.
     * @param ServiceService $serviceService
     * @param CommonSettingsInterface $commonSettings
     */
    public function __construct(ServiceService $serviceService, CommonSettingsInterface $commonSettings)
    {
        $this->serviceService = $serviceService;
        $this->commonSettings = $commonSettings;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('all_services', [$this, 'allServices']),
            new TwigFunction('get_setting', [$this, 'getSetting']),
        ];
    }

    public function allServices()
    {
        return $this->serviceService->findBy([],['queue' => 'ASC']);
    }

    public function getSetting($key)
    {
        return $this->commonSettings->get($key);
    }
}