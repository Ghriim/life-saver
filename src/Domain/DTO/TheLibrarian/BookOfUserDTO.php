<?php

namespace App\Domain\DTO\TheLibrarian;

use App\Domain\DTO\AbstractBaseDTO;

class BookOfUserDTO extends AbstractBaseDTO
{
    public bool $isWishlist = false;

    public bool $isOwned = false;

    public bool $isReading = false;

    public bool $isRead = false;

    public bool $isLiked = false;

    public BookDTO $book;

    public int $userId;
}