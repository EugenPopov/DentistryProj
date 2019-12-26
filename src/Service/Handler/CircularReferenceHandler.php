<?php


namespace App\Service\Handler;


class CircularReferenceHandler
{
    public function __invoke($object)
    {
        return $object->getId();
    }
}