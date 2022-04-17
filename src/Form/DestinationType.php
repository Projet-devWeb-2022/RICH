<?php

namespace App\Form;

use App\Entity\Country;
use App\Entity\Destination;
use App\Entity\Prestation;
use App\Repository\CountryRepository;
use App\Repository\PrestationRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DestinationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city')
            ->add('details')
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'mapped' => false,
                'query_builder' => function (CountryRepository $er) {
                    return $er->countryByCity();
                },
                'choice_label' => 'name',
            ])
            ->add('prestations', EntityType::class, [
                'class' => Prestation::class,
                'mapped' => false,
                'query_builder' => function (PrestationRepository $er) {
                    return $er->prestationByCity();
                },
                'choice_label' => 'name',
            ])
            ->add('valider', SubmitType::class)
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Destination::class,
        ]);
    }
}
