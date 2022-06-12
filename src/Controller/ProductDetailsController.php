<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductDetailsController extends AbstractController
{

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    #[Route('/produit/details/{slug}', name: 'app_product_details')]
    public function index($slug): Response
    {

        $singleProduct = $this->manager->getRepository(Product::class)->findOneBy(['slug' => $slug]);

        return $this->render('product_details/index.html.twig', [
            'singleProduct' => $singleProduct
        ]);
    }
}
