<?php


namespace App\Controller\Pages;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewController extends AbstractController
{


    public function index()
    {
        return $this->render('public/reviews.html.twig');
    }
}
