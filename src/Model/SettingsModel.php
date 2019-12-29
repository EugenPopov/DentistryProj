<?php


namespace App\Model;


use Doctrine\Common\Collections\ArrayCollection;

class SettingsModel
{
    /**
     * @var ArrayCollection
     */
    private $data;

    /**
     * SettingsModel constructor.
     * @param ArrayCollection $array |null $array
     */
    public function __construct(ArrayCollection $array)
    {
        $this->data = $array;
    }

    public function getAll(): ArrayCollection
    {
        return $this->data;
    }

    public function __get($key)
    {
        return $this->data->get($key)['value'];
    }

    public function __set($key, $value)
    {
        $row = $this->data->get($key);
        $row['value'] = $value;
        $this->data->set($key, $row);
    }
}