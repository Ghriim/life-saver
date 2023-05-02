<?php

namespace App\Infrastructure\Form\FormType\Player\BodyTracker;

use App\Domain\DTO\BodyTracker\SleepDTO;
use DateTimeImmutable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddSleepFormType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
                'inBed',
                DateTimeType::class,
                    [
                        'widget' => 'single_text',
                        'input' => 'datetime_immutable',
                    ])
                ->add(
                    'outOfBed',
                    DateTimeType::class,
                    [
                        'widget' => 'single_text',
                        'input' => 'datetime_immutable',
                        'required' => false
                    ]
                );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => SleepDTO::class]);
    }
}