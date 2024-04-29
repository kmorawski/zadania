<?php
namespace App\Tests\Unit;

use App\Exception\FileReaderException;
use Generator;
use PHPUnit\Framework\TestCase;
use App\TextFileReader;
use App\ReadStrategy\SmallFileRead;

class TextFileReaderTest extends TestCase
{
    private TextFileReader $textFileReader;

    protected function setUp(): void
    {
        $this->textFileReader = new TextFileReader(new SmallFileRead(__DIR__ . '/Fixtures/test_data.txt'));
    }

    public function testGetDataWhenNonexistent(): void
    {
        $filePath = '/path/to/nonexistent.file';
        $this->expectException(FileReaderException::class);
        $this->expectExceptionMessage('Failed to open file');

        $reader = new TextFileReader(new SmallFileRead($filePath));
        iterator_to_array($reader->getData());
    }

    public function testGetFileSizeTypeForSmallFile(): void
    {
        $this->assertFalse(
            TextFileReader::isLargeFile(__DIR__ . '/Fixtures/test_data.txt')
        );
    }

    public function testGetFileSizeTypeForLargeFile(): void
    {
        $this->assertTrue(
            TextFileReader::isLargeFile(__DIR__ . '/Fixtures/large_test_data.txt')
        );
    }

    public function testGetData(): void
    {
        $data = $this->textFileReader->getData();

        $this->assertInstanceOf(Generator::class, $data);
        $this->assertNotEmpty(iterator_to_array($data));
    }
}