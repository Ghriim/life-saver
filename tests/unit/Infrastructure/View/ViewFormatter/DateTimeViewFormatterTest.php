<?php

namespace App\Tests\Unit\Infrastructure\View\ViewFormatter;

use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use PHPUnit\Framework\TestCase;

final class DateTimeViewFormatterTest extends TestCase
{
    /**
     * @dataProvider dateTimeDataProvider
     */
    public function testToStringFormat(DateTimeInterface $datetime, string $expected): void
    {
        $result = DateTimeViewFormatter::toStringFormat($datetime);

        $this->assertEquals($expected, $result);
    }

    public function dateTimeDataProvider(): array
    {
        return [
            [new DateTimeImmutable('2022-01-01 01:01:01'), '2022-01-01 01:01:01'],
            [new DateTimeImmutable('12/12/2050 19:19:19'), '2050-12-12 19:19:19'],
            [new DateTime('2022-01-01 01:01:01'), '2022-01-01 01:01:01'],
            [new DateTime('12/12/2050 19:19:19'), '2050-12-12 19:19:19'],
        ];
    }
}
