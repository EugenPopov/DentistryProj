<?php


namespace App\Controller\Pages;


use App\Entity\Blog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    public function singlePost(Blog $blog)
    {
        return $this->render('public/single_post.html.twig', ['blog' => $blog]);
    }
}