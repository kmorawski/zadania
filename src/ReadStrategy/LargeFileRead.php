<?php

namespace App\ReadStrategy;

use App\Exception\FileReaderException;
use Generator;

class LargeFileRead implements FileReaderInterface
{
    /**
     * File path.
     *
     * @var string
     */
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Read large file.
     *
     * @return Generator
     *
     * @throws FileReaderException
     */
    private function readLargeFile(): Generator
    {
        $file = fopen($this->filePath, 'r');
        if (!$file) {
            throw new FileReaderException('Failed to open file');
        }

        while ($line = fgets($file)) {
            yield $line;
        }

        fclose($file);
    }

    /**
     * @inheritdoc
     *
     * @throws FileReaderException
     */
    public function getFileLines(): Generator
    {
        return $this->readLargeFile();
    }
}