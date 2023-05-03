<?php

namespace App\Infrastructure\Form\FormType\Player\BodyTracker;

use App\Domain\DTO\BodyTracker\WeightDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddWeightFormType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
                'weight',
                NumberType::class
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => WeightDTO::class]);
    }
}