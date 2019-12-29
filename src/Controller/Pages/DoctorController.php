<?php


namespace App\Controller\Pages;


use App\Entity\Doctor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DoctorController extends AbstractController
{

    public function index(Doctor $doctor)
    {
        dd($doctor->getSlug());
    }
}