<?php


namespace App\Service\CommonSettings;


use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Yaml\Yaml;

class CommonSettings implements CommonSettingsInterface
{
    private $setting_path;
    private $settings;

    /**
     * CommonSettings constructor.
     * @param $setting_path
     */
    public function __construct($setting_path)
    {
        $this->setting_path = $setting_path;
        $this->settings = new ArrayCollection(Yaml::parseFile($setting_path));
    }

    public function getAll(): ArrayCollection
    {
        return $this->settings;
    }

    public function get($key)
    {
        return $this->settings->get($key);
    }
}