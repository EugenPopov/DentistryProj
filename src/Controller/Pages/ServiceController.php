<?php


namespace App\Controller\Pages;


use App\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServiceController extends AbstractController
{
    public function index(Service $service)
    {
        return $this->render('public/single-service.html.twig');
    }

    public function ind()
    {
        return $this->render('public/services.html.twig');
    }
}
