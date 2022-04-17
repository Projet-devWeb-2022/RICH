<?php

namespace App\Form;

use App\Entity\Pack;
use App\Entity\Prestation;
use App\Entity\Travel;
use App\Entity\Destination;
use App\Entity\VehicleRental;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('nbPersonMax')
            ->add('destination', EntityType::class, [
                'class' => Destination::class,
                'mapped' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.city', 'ASC');
                },
                'choice_label' => 'city',
            ])
            ->add('prestations', EntityType::class, [
                'class' => VehicleRental::class,
                'mapped' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.price > :type1')
                        ->setParameter('type1', 0);

                },
                'choice_label' => 'name',
            ])
            ->add('valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pack::class,
        ]);
    }
}
