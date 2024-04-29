<?php

namespace App;

use App\ReadStrategy\FileReaderInterface;
use Generator;

interface ReaderInterface
{
    /**
     * Get data.
     *
     * @return Generator
     */
    public function getData(): Generator;

    /**
     * Set the file reader instance.
     *
     * @param FileReaderInterface $reader The file reader to set.
     *
     * @return void
     */
    public function setFileReader(FileReaderInterface $reader): void;
}
