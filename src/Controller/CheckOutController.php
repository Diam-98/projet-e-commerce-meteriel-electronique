<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckOutController extends AbstractController
{
    #[Route('/check/out', name: 'app_check_out')]
    public function index(): Response
    {
        return $this->render('check_out/index.html.twig', [
            'controller_name' => 'CheckOutController',
        ]);
    }
}
