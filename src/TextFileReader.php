<?php

namespace App;

use App\ReadStrategy\FileReaderInterface;
use Generator;

class TextFileReader implements ReaderInterface
{
    private const MAX_SMALL_FILE_SIZE = 512;

    /**
     * Class FileReader
     *
     * A class for reading file contents.
     */
    private FileReaderInterface $reader;

    public function __construct(FileReaderInterface $reader)
    {
        $this->reader = $reader;
    }

    /**
     * @inheritDoc
     */
    public function setFileReader(FileReaderInterface $reader): void
    {
        $this->reader = $reader;
    }

    public static function isLargeFile(string $filePath): bool
    {
        return (filesize($filePath) > self::MAX_SMALL_FILE_SIZE);
    }

    /**
     * @inheritDoc
     */
    public function getData(): Generator
    {
        foreach ($this->reader->getFileLines() as $line) {
            yield $line;
        }
    }
}
