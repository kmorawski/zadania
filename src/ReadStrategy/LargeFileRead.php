<?php

namespace App\ReadStrategy;

use Generator;
use RuntimeException;

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
     */
    private function readLargeFile(): Generator
    {
        $file = fopen($this->filePath, 'r');
        if (!$file) {
            throw new RuntimeException('Failed to open file.');
        }

        while ($line = fgets($file)) {
            yield $line;
        }

        fclose($file);
    }

    /**
     * @inheritdoc
     */
    public function getFileLines(): Generator
    {
        return $this->readLargeFile();
    }
}