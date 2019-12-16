<?php


namespace App\Controller\pages;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    public function index()
    {
        return $this->render('public/index_page.html.twig');
    }
}
