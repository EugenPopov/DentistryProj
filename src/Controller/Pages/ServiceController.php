<?php


namespace App\Controller\Pages;


use App\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController extends AbstractController
{
    public function index(Service $service)
    {
        dd($service->getSlug());
    }
}