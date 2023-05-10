<?php

namespace App\Infrastructure\Form\FormType\Player\ActivityTracker;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class SaveActivityFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
                'title',
                TextType::class,
                );
    }
}
