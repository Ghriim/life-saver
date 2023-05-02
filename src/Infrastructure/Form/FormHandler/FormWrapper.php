<?php

namespace App\Infrastructure\Form\FormHandler;

use App\Domain\DTO\AbstractBaseDTO;
use Symfony\Component\Form\FormInterface;

final class FormWrapper
{
    private AbstractBaseDTO $dto;

    private FormInterface $form;

    private bool $isHandledSuccessfully = false;

    public function __construct(AbstractBaseDTO $dto, FormInterface $form)
    {
        $this->dto = $dto;
        $this->form = $form;
    }

    public function getDto(): AbstractBaseDTO
    {
        return $this->dto;
    }

    public function getForm(): FormInterface
    {
        return $this->form;
    }

    public function isHandledSuccessfully(): bool
    {
        return $this->isHandledSuccessfully;
    }

    public function setIsHandledSuccessfully(bool $isHandledSuccessfully): void
    {
        $this->isHandledSuccessfully = $isHandledSuccessfully;
    }
}