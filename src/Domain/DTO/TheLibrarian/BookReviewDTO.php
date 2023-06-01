<?php

namespace App\Domain\DTO\TheLibrarian;

use App\Domain\DTO\AbstractBaseDTO;

class BookReviewDTO extends AbstractBaseDTO
{
    public int $evaluation;

    public string $review;

    public int $userId;

    public BookDTO $book;
}