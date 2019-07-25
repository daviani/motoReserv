<?php

namespace App\Form;

use App\Entity\BikeOwner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BikeOwnerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'person.gender.male.label' => 1,
                    'person.gender.female.label' => 2,
                    'person.gender.apache_copter.label' => 3,
                    'person.gender.other.label' => 4,
                ],
            ])
            ->add('firstName')
            ->add('lastName')
            ->add('address')
            ->add('city')
            ->add('postalCode')
            ->add('mail')
            ->add('phone')
            ->add('bithDate')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BikeOwner::class,
        ]);
    }
}
