<?php


namespace App\Controller\Pages;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PromotionsController extends AbstractController
{


    public function index()
    {
        return $this->render('public/promotions.html.twig');
    }
}
