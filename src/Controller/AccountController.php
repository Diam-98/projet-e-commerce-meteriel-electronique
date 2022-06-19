<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Entity\User;
use App\Form\AdressType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->manager = $entityManager;
    }

    #[Route('/compte', name: 'app_account')]
    public function index(Request $request): Response
    {
        $address = new Adress();

        $form = $this->createForm(AdressType::class, $address);
        $userForm = $this->createForm(RegistrationFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $address = $form->getData();
            $address->setUser($this->getUser());

            $this->manager->persist($address);
            $this->manager->flush();
        }

        $user = $this->getUser();
        $addresses = $user->getAddresses();
//        dd($addresses);

        return $this->render('account/index.html.twig', [
            'form' => $form->createView(),
            'addresses' => $addresses,
            'userForm' =>$userForm->createView()
        ]);
    }

    #[Route('/compte/adresse/supprimer/{id}', name: 'delete_address')]
    public function deleteAddress($id){
        $address = $this->manager->getRepository(Adress::class)->findOneBy(['id' => $id]);
        $this->manager->remove($address);
        $this->manager->flush();

        return $this->redirectToRoute('app_account');
    }
}
