<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Publicity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_home')]
    public function index(SessionInterface $session): Response
    {

        $categories = $this->entityManager
            ->getRepository(Category::class)->findAll();
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        $publicities = $this->entityManager->getRepository(Publicity::class)->findAll();
//        dd($publicities);


//        dd($categories);

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'products' => $products,
            'publicities' => $publicities
        ]);
    }
}
