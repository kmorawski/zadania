<?php

namespace App;

use App\ReadStrategy\FileReaderInterface;
use Generator;

class Converter implements ReaderInterface
{
    protected ReaderInterface $fileReader;

    public function __construct(ReaderInterface $fileReader)
    {
        $this->fileReader = $fileReader;
    }

    /**
     * @inheritDoc
     */
    public function getData(): Generator
    {
        return $this->fileReader->getData();
    }

    /**
     * @inheritDoc
     */
    public function setFileReader(FileReaderInterface $reader): void
    {
        $this->fileReader->setFileReader($reader);
    }
}