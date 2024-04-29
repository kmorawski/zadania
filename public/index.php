<?php

use App\FileClient;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$existingFilePath = 'demo_file.txt';
$notExistingFilePath = 'demo_file_x.txt';
$veryLargeFilePath = 'vv_large.txt';
$existingFilePathFallBack = 'demo_file_one_line.txt';
$notExistingFilePathFallBack = 'demo_file_one_line1.txt';
$withConvert = true;

$client = new FileClient($existingFilePath);
$client->readFile($notExistingFilePath, $withConvert);
