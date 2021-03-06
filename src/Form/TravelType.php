<?php

namespace App\Form;

use App\Entity\Destination;
use App\Entity\Travel;
use App\Entity\Vehicle;
use App\Repository\DestinationRepository;
use App\Repository\TravelRepository;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TravelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price')
            ->add('isAvailable')
            ->add('name')
            ->add('description')
            ->add('nbPersonMax')
            ->add('image')
            ->add('airportDeparture')
            ->add('dateDeparture')
            ->add('departureTime')
            ->add('airportArrival')
            ->add('arrivalTime')
            ->add('dateArrival')
            ->add('destination', EntityType::class, [
                'class' => Destination::class,
                'mapped' => false,
                'query_builder' => function (DestinationRepository $travelRepository) {
                    return $travelRepository->travelByCity();
                },
                'choice_label' => 'city',
            ])
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
            'data_class' => Travel::class,
        ]);
    }
}
