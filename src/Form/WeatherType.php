<?php

namespace App\Form;

use App\Entity\Weather;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Type;

class WeatherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', type: DateType::class)
            ->add('celsius', type: IntegerType::class, options: [
                'constraints' => [
                    new NotNull(['groups' => ['create', 'edit']]),
                    new Range(['min'=>-30, 'max' => 50, 'groups' => ['create', 'edit']])
                ]])
            ->add('windSpeed', IntegerType::class, options: [
                'constraints' => [
                    new NotNull(['groups' => ['create', 'edit']]),
                    new Range(['min'=>0, 'max' => 200, 'groups' => ['create', 'edit']])
                ]])
            ->add('precipitation',PercentType::class)
            ->add('location', type: EntityType::class,options: [
                'class' => 'App\Entity\Location',
                'choice_label' => 'city'
            ])
            ->setRequired(false)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Weather::class,
        ]);
    }
}
