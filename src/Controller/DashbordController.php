<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashbordController extends AbstractController
{
    /**
     * @Route("/dashbord", name="dashbord")
     */
    public function index()
    {
        return $this->render('dashbord/index.html.twig', [
            'controller_name' => 'DashbordController',
        ]);
    }
}
