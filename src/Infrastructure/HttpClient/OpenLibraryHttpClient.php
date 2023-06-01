<?php

namespace App\Infrastructure\HttpClient;

use App\Domain\DTO\TheLibrarian\BookAuthorDTO;
use App\Domain\DTO\TheLibrarian\BookDTO;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class OpenLibraryHttpClient
{
    public function __construct(
        private HttpClientInterface $openLibraryClient,
    ) {

    }

    public function fetchBookByISBN(string $isbn): ?BookDTO
    {
        try {
            $response = $this->openLibraryClient->request('GET',  "https://openlibrary.org/isbn/{$isbn}.json");
            if (Response::HTTP_OK !== $response->getStatusCode()) {
                return null;
            }

            $result = json_decode($response->getContent());

            $book = new BookDTO();
            $book->title = $result->title;
            $book->isbn10 = $result->isbn_10[0];
            $book->isbn13 = $result->isbn_13[0];
            $book->openLibraryId = explode("/", $result->key)[2];
            $book->numberOfPages = $this->getProperty($result, 'number_of_pages');
            $book->publishedDate = $this->getProperty($result, 'publish_date');

            return $this->parseWorks($book, $result->works);

            /*
                'physicalFormat' => $result->physical_format,
                'coverURLs' => $this->getCoverURLs($result->covers),
                'publishers' => $result->publishers,
            ];*/
        } catch (TransportExceptionInterface $exception) {
            // TODO: handle error
        }

        return null;
    }

    private function parseWorks(BookDTO $book, array $works): BookDTO
    {
        foreach ($works as $work) {
            try {
                $response = $this->openLibraryClient->request('GET',  "https://openlibrary.org/{$work->key}.json");
                if (Response::HTTP_OK !== $response->getStatusCode()) {
                    continue;
                }

                $result = json_decode($response->getContent());

                if (isset($result->description) && false === empty($result->description)) {
                    $book->description = $result->description;
                }

                if (true === empty($book->getAuthors())) {
                    $book->setAuthors($this->getAuthorsDetails($this->getProperty($result, 'authors', [])));
                }
            } catch (TransportExceptionInterface $exception) {
                // TODO: handle error
            }
        }

        return $book;
    }

    private function getCoverURLs(array $covers): array
    {
        $coverURLs = [];
        foreach ($covers as $cover) {
            $coverURLs[] = "https://covers.openlibrary.org/b/id/{$cover}-L.jpg";
        }

        return $coverURLs;
    }

    private function getAuthorsDetails(?array $authorKeys): array
    {
        $authors = [];
        foreach ($authorKeys as $authorKey) {
            $response = $this->openLibraryClient->request('GET',  "https://openlibrary.org/{$authorKey->author->key}.json");
            if (Response::HTTP_OK !== $response->getStatusCode()) {
                continue;
            }

            $result = json_decode($response->getContent());

            $author = new BookAuthorDTO();
            $author->fullName = $result->name;
            $author->openLibraryKey = $result->key;

            $authors[] = $author;
        }

        return $authors;
    }

    private function getProperty(\stdClass $result, string $propertyName, mixed $default = null): null|int|string|array
    {
        return property_exists($result, $propertyName) ? $result->{$propertyName} : $default;
    }
}