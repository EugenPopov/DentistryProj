<?php


namespace App\Twig  ;


use App\Repository\MainPageSliderRepository;
use App\Service\CommonSettings\CommonSettingsInterface;
use App\Service\ServiceService;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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
     * @var SessionInterface
     */
    private $session;

    /**
     * AppExtension constructor.
     * @param ServiceService $serviceService
     * @param CommonSettingsInterface $commonSettings
     * @param SessionInterface $session
     */
    public function __construct(
        ServiceService $serviceService,
        CommonSettingsInterface $commonSettings,
        SessionInterface $session
        )
    {
        $this->serviceService = $serviceService;
        $this->commonSettings = $commonSettings;
        $this->session = $session;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('all_services', [$this, 'allServices']),
            new TwigFunction('get_setting', [$this, 'getSetting']),
            new TwigFunction('get_preloader_show', [$this, 'getPreloaderShow']),
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

    public function getPreloaderShow(): bool
    {
        $show = $this->session->has('preloader_show');
        if(!$show){
            $this->session->set('preloader_show', true);
            $this->session->save();
        }

        return !$show;
    }
}