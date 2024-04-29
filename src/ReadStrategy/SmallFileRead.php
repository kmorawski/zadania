<?php

namespace App\ReadStrategy;

use App\Exception\FileReaderException;
use Generator;

class SmallFileRead implements FileReaderInterface
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
     * @inheritdoc
     * @throws FileReaderException
     */
    public function getFileLines(): Generator
    {
        foreach ($this->fileLines() as $line) {
            yield $line;
        }
    }

    /**
     * File lines.
     *
     * @return array
     *
     * @throws FileReaderException
     */
    private function fileLines(): array
    {
        $lines = file($this->filePath);

        if (!$lines) {
            throw new FileReaderException('Failed to open file');
        }

        return $lines;
    }
}