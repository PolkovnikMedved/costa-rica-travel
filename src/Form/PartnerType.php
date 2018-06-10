<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Partner;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class PartnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('phone', TextType::class)
            ->add('address', TextareaType::class)
            ->add('imageFile', FileType::class, ['required' => false])
            ->add('latitude', NumberType::class)
            ->add('longitude', NumberType::class)
            ->add('horary', TextType::class)
            ->add('comment', TextType::class)
            ->add('isSpecialOffer', CheckboxType::class, ['required' => false])
            ->add('offer', TextType::class)
            ->add('tripAdvisorLink', TextType::class)
            ->add('country', TextType::class)
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name'
            ])
            ->add('type', EntityType::class, [
                'class' => \App\Entity\PartnerType::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
        ]);
    }
}
