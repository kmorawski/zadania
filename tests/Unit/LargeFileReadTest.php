<?php
namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\ReadStrategy\LargeFileRead;
use RuntimeException;

class LargeFileReadTest extends TestCase
{
    public function testReadLargeFileWhenFileNotExists(): void
    {
        $filePath = '/path/to/nonexistent.file';
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Failed to open file');

        $reader = new LargeFileRead($filePath);
        iterator_to_array($reader->getFileLines());
    }

    /**
     * Test LargeFileRead generator.
     *
     * @return void
     */
    public function testReadLargeFile(): void
    {
        $filePath = __DIR__ . '/Fixtures/test_data_1.txt';
        $reader = new LargeFileRead($filePath);

        $lines = iterator_to_array($reader->getFileLines());

        $this->assertEquals(["linia 1\r\n","linia 2\r\n","linia 3\r\n","linia 4\r\n"], $lines);
    }
}