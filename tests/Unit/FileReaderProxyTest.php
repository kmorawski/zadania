<?php

namespace App\Tests\Unit;

use App\FileReaderProxy;
use App\ReaderInterface;
use Generator;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;

class FileReaderProxyTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGetData(): void
    {
        $testData = ['line1', 'line2', 'line3'];

        $mockFileReader = $this->createMock(ReaderInterface::class);

        $mockFileReader->method('getData')
            ->willReturn($this->mockGenerator($testData));

        $fileReaderProxy = new FileReaderProxy($mockFileReader);

        $this->assertInstanceOf(Generator::class, $fileReaderProxy->getData());

        $returnedData = iterator_to_array($fileReaderProxy->getData());

        $this->assertEquals($testData, $returnedData);
    }

    private function mockGenerator(array $array): Generator
    {
        foreach ($array as $item) {
            yield $item;
        }
    }
}