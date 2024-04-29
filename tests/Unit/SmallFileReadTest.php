<?php
namespace App\Tests\Unit;

use App\Exception\FileReaderException;
use App\ReadStrategy\SmallFileRead;
use PHPUnit\Framework\TestCase;

class SmallFileReadTest extends TestCase
{
    /**
     * Test getFileLines method.
     */
    public function testReadSmallFile(): void
    {
        $filePath = __DIR__ . '/Fixtures/testfile.txt';
        $reader = new SmallFileRead($filePath);
        $lines = iterator_to_array($reader->getFileLines());

        // Compare read lines to expected lines.
        $expectedLines = ["linia 1\r\n", "linia 2\r\n", "linia 3\r\n", "linia 4"];
        $this->assertEquals($expectedLines, $lines);
    }

    /**
     * Test failure case.
     */
    public function testReadNonexistentFile(): void
    {
        $filePath = '/path/to/nonexistent.file';
        $this->expectException(FileReaderException::class);
        $this->expectExceptionMessage('Failed to open file');

        $reader = new SmallFileRead($filePath);
        iterator_to_array($reader->getFileLines());
    }
}