<?php

namespace App\Infrastructure\Form\FormType\Player\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationIntakeDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddHydrationIntakeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'volume',
            IntegerType::class,
            [
                'attr' => ['min' => 0]
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => HydrationIntakeDTO::class]);
    }

}