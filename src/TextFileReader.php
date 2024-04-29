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

    /**
     * Get the file size type based on the given file path.
     *
     * @param string $filePath The path of the file to check.
     *
     * @return FileSizeTypeEnum The file size type determined.
     */
    public static function getFileSizeType(string $filePath): FileSizeTypeEnum
    {
        return (filesize($filePath) > self::MAX_SMALL_FILE_SIZE)
            ? FileSizeTypeEnum::LARGE
            : FileSizeTypeEnum::SMALL;
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
