<?php

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

//Styles Array
$arrayStyleFirstRow = [
    'font' => [
        'bold' => true,
    ]
];

$coordinates = ['A1','B1','C1','D1','E1'];
$FirstStr = ['Id','ШК','Название','Кол-во','Сумма'];

//Bold first text
foreach ($coordinates as $item) {
    $sheet->getStyle($item)->applyFromArray($arrayStyleFirstRow);
}
for($i = 0; $i < count($coordinates); $i++){
    $sheet->setCellValue($coordinates[$i], $FirstStr[$i]);
}

// Записываем в ячейку A1 данные
$sheet->setCellValue('A2', 47323424);
$sheet->setCellValue('B2', 47323424);

try {
    $writer = new Xlsx($spreadsheet);
    $writer->save('hello.xlsx');
} catch
(\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
}
