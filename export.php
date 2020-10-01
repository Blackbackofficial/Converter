<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class XlsExchange
{
    protected $path_to_input_json_file;
    protected $path_to_output_xlsx_file;
    protected $ftp_host;
    protected $ftp_login;
    protected $ftp_password;
    protected $ftp_dir;

    /**
     * Функция экспорта из Json в Xlsx
     */
    public function export()
    {
        $path = new XlsExchange();
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
        for ($i = 0; $i < count($coordinates); $i++) {
            $sheet->setCellValue($coordinates[$i], $firstStr[$i]);
        }

        // Обязательно надо указать сам файл
        $json = json_decode(file_get_contents($path['path_to_input_json_file']), true, 512, JSON_UNESCAPED_UNICODE);
        $json = $json['items'];

        for ($j = 0; $j < count($json); $j++) {
            $sheet->setCellValue('A'.($j+2), $json[$j]['id']);
            $sheet->setCellValue('B'.($j+2), '000000'.$json[$j]['item']['external_code']);
            $sheet->setCellValue('C'.($j+2), $json[$j]['item']['name']);
            $sheet->setCellValue('D'.($j+2), $json[$j]['quantity']);
            $sheet->setCellValue('E'.($j+2), $json[$j]['amount']);
        }

        try {
            $writer = new Xlsx($spreadsheet);
            // Обязательно надо указать сам файл
            $writer->save($path['path_to_output_xlsx_file']);
        } catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
        }
    }

    /**
     * Функция отправки файла Xlsx на FTP сервер
     */
    public function sendFileXlsx()
    {
        $property = new XlsExchange();
        if($property['ftp_host']) {
            $this->export();
        }
        $connect = ftp_connect($property['ftp_host']);
        if ($connect) {
            // Не анонимный
            ftp_login($connect, $property['ftp_login'], $property['ftp_password']);
            ftp_get($connect, $property['path_to_output_xlsx_file'],  'items.json', FTP_ASCII);
            ftp_quit($connect);
        } else {
            echo("Ошибка соединения");
        }
        exit;
    }
}
