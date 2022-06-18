<?php

namespace App\Classe;



use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart
{

//    private SessionInterface $session;
//
//    /**
//     * @param SessionInterface $session
//     */
//    public function __construct(SessionInterface $session)
//    {
//        $this->session = $session;
//    }
//
//    public function add($id): void {
//        $cart = $this->session->get('cart', []);
//        if(!empty($cart[$id])){
//            $cart[$id]++;
//        }else{
//            $cart[$id] = 1;
//        }
//    }
//
//    public function remove(){
//        return $this->session->remove('cart');
//    }
//
//    public function get(){
//        return $this->session->get('cart');
//    }
}