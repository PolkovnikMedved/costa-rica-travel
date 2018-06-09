<?php

namespace App\Form;

use App\Entity\Partner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('phone')
            ->add('address')
            ->add('picture')
            ->add('latitude')
            ->add('longitude')
            ->add('horary')
            ->add('comment')
            ->add('isSpecialOffer')
            ->add('offer')
            ->add('tripAdvisorLink')
            ->add('country')
            ->add('location')
            ->add('type')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
        ]);
    }
}
