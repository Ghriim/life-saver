<?php

namespace App\Tests\Unit\Infrastructure\View\ViewFormatter;

use App\Infrastructure\View\ViewFormatter\DurationViewFormatter;
use LogicException;
use PHPUnit\Framework\TestCase;

final class DurationViewFormatterTest extends TestCase
{
    /**
     * @dataProvider durationDataProvider
     */
    public function testToHMFormatForValidDuration(int $duration, string $expected): void
    {
        $result = DurationViewFormatter::toHMFormat($duration);

        $this->assertEquals($expected, $result);
    }

    public function testToHMFormatForDurationBiggerThanADay(): void
    {
        $this->expectException(LogicException::class);

        DurationViewFormatter::toHMFormat(100000);
    }

    public function durationDataProvider(): array
    {
        return [
            [600, '10 minutes'],
            [3600, '1 hour'],
            [3660, '1 hour and 1 minute'],
            [28987, '8 hours and 3 minutes'],
            [49652, '13 hours and 47 minutes'],
        ];
    }
}