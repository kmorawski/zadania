<?php

namespace App\ReadStrategy;

use Generator;
use RuntimeException;

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
     */
    private function fileLines(): array
    {
        $lines = file($this->filePath);

        if (!$lines) {
            throw new RuntimeException(sprintf('Failed to open file: %s.', $this->filePath));
        }

        return $lines;
    }
}