<?php

namespace App\Form;

use App\Entity\Vehicle;
use App\Entity\VehicleRental;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentalVehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price')
            ->add('isAvailable')
            ->add('name')
            ->add('description',TextareaType::class)
            ->add('nbPersonMax')
            ->add('image')
            ->add('PickingAddress')
            ->add('pickUpDate', DateTimeType::class)
            ->add('dropOffDate',DateTimeType::class)
            ->add('vehicle', EntityType::class, [
                'class' => Vehicle::class,
                'query_builder' => function (VehicleRepository $er) {
                    return $er->findAllVehicles();
                },
                'choice_label' => 'name',
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VehicleRental::class,
        ]);
    }
}
