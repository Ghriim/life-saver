<?php

namespace App\Domain\DTO\TheLibrarian;

use App\Domain\DTO\AbstractBaseDTO;
use App\Domain\Registry\TheLibrarian\BookStatusRegistry;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class BookDTO extends AbstractBaseDTO
{
    public string $isbn10;
    public string $isbn13;
    public ?string $openLibraryId;

    public string $title;
    public ?string $description;
    public ?int $numberOfPages;
    public ?string $publishedDate;

    public string $status = BookStatusRegistry::STATUS_CREATED;

    private Collection $authors;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
    }

    public function setAuthors(array $authors)
    {
        $this->authors->clear();
        foreach ($authors as $author) {
            $this->authors->add($author);
        }
    }

    /**
     * @return BookAuthorDTO[]
     */
    public function getAuthors(): array
    {
        return $this->authors->toArray();
    }
}