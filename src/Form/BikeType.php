<?php

namespace App\Form;

use App\Entity\Bike;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BikeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('brand')
            ->add('model')
            ->add('matriculation')
            ->add('color')
            ->add('power')
            ->add('km')
            ->add('productionYear', DateType::class, [
                'widget' => 'choice',
                'input_format' => 'Y',
                'years' => range('1970', date('Y'),1),
            ])
            ->add('status')
            ->add('tags')
            ->add('bikeOwner')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bike::class,
        ]);
    }
}
