<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    #[Route('/categories/{slug}', name: 'app_category')]
    public function index($slug): Response
    {
        $categoryBySlug = $this->manager->getRepository(Category::class)->findOneBy(['slug' => $slug]);
        $productBySlug = $categoryBySlug->getProducts();
//        dd($productBySlug);

        return $this->render('category/index.html.twig', [
            'products' => $productBySlug
        ]);
    }
}
