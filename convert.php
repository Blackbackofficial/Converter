<?php

require 'vendor/autoload.php';

$inputFileName = './items.xlsx';
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
$sheetData = $spreadsheet->getActiveSheet()->toArray();

$data = [];

echo "Convert xlsx to json\n";

// header
$headers = $sheetData[0];
unset($sheetData[0]);

// data
$index = 1;
foreach ($sheetData as $row) {
    $item = [];
    foreach ($row as $key => $value) {
        $column = $headers[$key];
        $item[$column] = $value;
    }

    $data[] = $item;
    $index++;
}

$json = json_encode($data, JSON_UNESCAPED_UNICODE);
$outputFileName = './data/items.json';
file_put_contents($outputFileName, $json);

echo "Job is done\n";
