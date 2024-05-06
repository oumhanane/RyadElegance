<?php

namespace App\Form;

use App\Entity\user;
use App\Entity\Invoice;
use App\Entity\Purchase;
use App\Entity\ListProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PurchaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('country', TextType::class,[
                'label' =>'Pays',
                'required' => false
            ])
            ->add('city', TextType::class,[
                'label' =>'Ville',
                'required' => false
            ])
            ->add('street', TextType::class,[
                'label' =>'Numéro et Rue',
                'required' => false
            ])
            ->add('postalCode', TextType::class,[
                'label' =>'Code Postal',
                'required' => false
            ])
            ->add('telephone', TextType::class,[
                'label' =>'téléphone',
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Purchase::class,
        ]);
    }
}
