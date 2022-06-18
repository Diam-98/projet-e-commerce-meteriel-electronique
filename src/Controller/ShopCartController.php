<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ShopCartController extends AbstractController
{

    private EntityManagerInterface $manager;
//    private Cart $cart;

    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    #[Route('/panier', name: 'app_shop_cart')]
    public function index(SessionInterface $session): Response
    {
        $completeCart = [];
        if (!empty($session->get('cart'))){
            foreach ($session->get('cart') as $id => $quantity){
                $product_obj = $this->manager->getRepository(Product::class)->findOneBy(['id' => $id]);
                if (!$product_obj){
                    unset($completeCart[$id]);
                    continue;
                }else{
                    $completeCart[] = [
                        'product' => $product_obj,
                        'quantity' => $quantity
                    ];
                }
            }
        }

//        dd($completeCart);

        return $this->render('shop_cart/index.html.twig', [
            'cart' => $completeCart
        ]);
    }

    #[Route('/panier/ajouter/{id}', name: 'add_to_cart')]
    public function add(SessionInterface $session, $id){
//        $this->cart->add($id);

        $cart = $session->get('cart', []);
        if(!empty($cart[$id])){
            $cart[$id]++;
        }else{
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);

        $count = 0;
        if (!empty($session->get('cart'))){
            foreach ($session->get('cart') as $quantity){
                $count = $count + $quantity;
            }
        }

//        return $this->redirectToRoute('app_shop_cart');
        return $this->json([
            'code'=>200,
            'message' => 'ca marche',
            'count' => $count
        ], 200);
    }


    #[Route('/panier/suprimer/{id}', name: 'decrease_to_cart')]
    public function deleteProd(SessionInterface $session, $id){

        $cart = $session->get('cart', []);
        if(!empty($cart[$id])){
            $cart[$id]--;
        }else{
            unset($cart[$id]);
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('app_shop_cart');
    }

    #[Route('/panier/ajout/{id}', name: 'increase_to_cart')]
    public function increaseProd(SessionInterface $session, $id){

        $cart = $session->get('cart', []);
        if(!empty($cart[$id])){
            $cart[$id]++;
        }else{
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('app_shop_cart');
    }


    #[Route('/panier/vider', name: 'empty_cart')]
    public function remove(SessionInterface $session){
        $session->remove('cart');

        return $this->redirectToRoute('app_shop_cart');
    }

    #[Route('/panier/suprimer/{id}', name: 'delete_from_cart')]
    public function countProducts(SessionInterface $session, $id):Response{

        $cart = $session->get('cart', []);

        unset($cart[$id]);

        $session->set('cart', $cart);

        return $this->redirectToRoute('app_shop_cart');

    }
}
