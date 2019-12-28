<?php


namespace App\Service\CommonSettings;


interface CommonSettingsInterface
{
    public function getAll();
    public function get($key);
}