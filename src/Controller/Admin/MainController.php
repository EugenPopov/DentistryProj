<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MainController extends AbstractController
{
    public function index()
    {
        return $this->redirectToRoute('application_index');
    }
}