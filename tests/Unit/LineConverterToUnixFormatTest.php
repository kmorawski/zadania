<?php

namespace App\Tests\Unit;

use App\LineConverterToUnixFormat;
use App\ReaderInterface;
use Generator;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class LineConverterToUnixFormatTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGetData(): void
    {
        $fileReader = $this->createMock(ReaderInterface::class);

        $data = ["Hello\r\n", "World\r\n"];
        $fileReader->method('getData')
            ->willReturn($this->mockDataGenerator($data));

        $converter = new LineConverterToUnixFormat($fileReader);

        $convertedData = iterator_to_array($converter->getData());

        $this->assertSame(["Hello\n", "World\n"], $convertedData);
    }

    private function mockDataGenerator(array $data): Generator
    {
        foreach ($data as $item) {
            yield $item;
        }
    }
}