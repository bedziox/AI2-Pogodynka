<?php

namespace App\Form;

use App\Entity\Location;
use Decimal\Decimal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Range;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', type: TextType::class , options: [
                'attr' => [
                    'placeholder' => 'Enter city name',
                ],
                'constraints' => [
                    new NotNull(['groups' => ['create', 'edit']])
                ]
            ])
            ->add('country', type: ChoiceType::class, options: [
                'choices' => [
                    'Poland' => 'PL',
                    'Germany' => 'DE',
                    'France' => 'FR',
                    'Spain' => 'ES',
                    'Italy' => 'IT',
                    'United Kingdom' => 'GB',
                    'United Stated' => 'US',
                ],
            ])
            ->add('latitude', type: NumberType::class, options: [
                'constraints' => [
                    new NotNull(['groups' => ['create', 'edit']]),
                    new Range(['min'=>-90, 'max' => 90, 'groups' => ['create', 'edit']])
                ]
            ])
            ->add('longitude', type: NumberType::class, options: [
                'constraints' => [
                    new NotNull(['groups' => ['create', 'edit']]),
                    new Range(['min'=>-180, 'max' => 180, 'groups' => ['create', 'edit']])
                ]])
            ->setRequired(false)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
