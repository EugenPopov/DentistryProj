<?php


namespace App\Service\CommonSettings;


use Doctrine\Common\Collections\ArrayCollection;

interface CommonSettingsInterface
{
    public function getAll($with_label = false): ?ArrayCollection;
    public function get(string $key): ?string;
    public function set(string $key): void;
    public function setAll(ArrayCollection $array): void;
    public function flush(): void;
    public function save(ArrayCollection $array): void;
}