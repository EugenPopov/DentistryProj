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

    public function getAll($with_label = false): ArrayCollection
    {
        if(!$with_label){
            $array = [];
            foreach ($this->settings as $key => $setting) {
                $array[$key] = $setting['value'];
            }
            return new ArrayCollection($array);
        }
        return $this->settings;
    }

    public function get(string $key): ?string
    {
        return $this->settings->get($key)['value'];
    }

    public function set(string $key): void
    {
        dd($key);
    }

    public function flush(): void
    {
        file_put_contents($this->setting_path, Yaml::dump($this->settings->toArray()));
    }

    public function setAll(ArrayCollection $array): void
    {
        $this->settings = $array;
    }
}