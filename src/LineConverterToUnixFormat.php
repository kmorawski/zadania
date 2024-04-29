<?php

namespace App;

use Generator;

class LineConverterToUnixFormat extends Converter
{
    /**
     * @inheritDoc
     */
    public function getData(): Generator
    {
        foreach ($this->fileReader->getData() as $line) {
            yield str_replace(["\r\n"], "\n", $line);
        }
    }
}
