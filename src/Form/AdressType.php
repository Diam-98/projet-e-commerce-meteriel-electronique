<?php

namespace App\Form;

use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Adresse',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('street', TextType::class,[
                'label' => 'Rue',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('appartement', TextType::class, [
                'label' => 'Appartemet',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-info'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adress::class,
        ]);
    }
}
