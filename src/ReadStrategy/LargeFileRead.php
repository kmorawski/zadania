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

    const BUFFER_SIZE = 4096;

    /**
     * Read large file.
     *
     * @return Generator
     */
    private function readLargeFile(): Generator
    {
        $file = fopen($this->filePath, 'r');
        if (!$file) {
            throw new RuntimeException(sprintf('Failed to open file: %s.', $this->filePath));
        }

        $buffer = '';
        while (!feof($file)) {
            $buffer .= fread($file, self::BUFFER_SIZE);

            $lines = explode("\r\n", $buffer);

            // Zwraca linie odczytane w buforze
            while (count($lines) > 1) {
                yield array_shift($lines) . "\r\n";
            }

            // Niepełną linia do bufora
            $buffer = end($lines);
        }

        if (!empty($buffer)) {
            yield $buffer;
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