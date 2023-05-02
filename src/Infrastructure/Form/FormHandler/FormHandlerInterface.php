<?php

namespace App\Infrastructure\Form\FormHandler;

use Symfony\Component\HttpFoundation\Request;

interface FormHandlerInterface
{
    public function handle(Request $request, ?string $context = null): FormWrapper;
}