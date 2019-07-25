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
            ->add('power')
            ->add('km')
            ->add('color')
            ->add('productionYear', DateType::class, [
                'label' => 'bikes.form.productionYear.label',
                'widget' => 'choice',
                'format' => 'y-M-d',
                'years' => range('1970', date('Y'), 1),
            ])
            ->add('status')
            ->add('Tags')
            ->add('bikeOwner');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bike::class,
        ]);
    }
}
