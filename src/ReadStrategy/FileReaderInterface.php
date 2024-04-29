<?php

namespace App\ReadStrategy;

use Generator;

interface FileReaderInterface
{
    /**
     * Read lines.
     *
     * @return Generator
     */
    public function getFileLines(): Generator;
}