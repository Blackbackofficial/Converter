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
$firstStr = ['Id','ШК','Название','Кол-во','Сумма'];

//Bold first text
foreach ($coordinates as $item) {
    $sheet->getStyle($item)->applyFromArray($arrayStyleFirstRow);
}
for($i = 0; $i < count($coordinates); $i++){
    $sheet->setCellValue($coordinates[$i], $firstStr[$i]);
}

$json = json_decode(file_get_contents('order.json' ), true, 512,JSON_UNESCAPED_UNICODE);
$json = $json['items'];

// Записываем в ячейки данные
for($j = 0; $j < count($json); $j++) {
    $sheet->setCellValue('A'.($j+2), $json[$j]['id']);
    $sheet->setCellValue('B'.($j+2), '000000'.$json[$j]['item']['external_code']);
    $sheet->setCellValue('C'.($j+2), $json[$j]['item']['name']);
    $sheet->setCellValue('D'.($j+2), $json[$j]['quantity']);
    $sheet->setCellValue('E'.($j+2), $json[$j]['amount']);
}
try {
    $writer = new Xlsx($spreadsheet);
    $writer->save('hello.xlsx');
} catch
(\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
}
