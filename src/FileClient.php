<?php

namespace App;

use App\ReadStrategy\LargeFileRead;
use App\ReadStrategy\SmallFileRead;
use PHPUnit\Runner\FileDoesNotExistException;

class FileClient
{
    private string $filePathFallBack;

    public function __construct(string $filePathFallBack)
    {
        $this->filePathFallBack = $filePathFallBack;
    }

    /**
     * Read file.
     *
     * @param string $filePath
     * @param bool|null $withConvert
     *
     * @return void
     */
    public function readFile(string $filePath, ?bool $withConvert): void
    {
        echo '<pre>';

        $fileToRead = $filePath;

        if (file_exists($fileToRead)) {
            $textReader = new TextFileReader(new SmallFileRead($fileToRead));
            echo 'NO_PROXY' . PHP_EOL;
        } else if (file_exists($this->filePathFallBack))  {
            $fileToRead = $this->filePathFallBack;
            $textReader = new FileReaderProxy(new TextFileReader(new SmallFileRead($fileToRead)));
            echo 'PROXY' . PHP_EOL;
        } else {
            throw new FileDoesNotExistException($this->filePathFallBack);
        }

        if (TextFileReader::isLargeFile($fileToRead)) {
            echo 'LARGE' . PHP_EOL;
            $textReader->setFileReader(new LargeFileRead($fileToRead));
        } else {
            echo 'SMALL' . PHP_EOL;
        }

        if ($withConvert) {
            // Zastosowanie dekoratora
            $textReader = new LineConverterToUnixFormat($textReader);
            echo 'WITH CONVERT' . PHP_EOL;
        } else {
            echo 'WITHOUT CONVERT' . PHP_EOL;
        }

        foreach ($textReader->getData() as $line) {
            echo $line;
        }

        echo '</pre>';
    }
}