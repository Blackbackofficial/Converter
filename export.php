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

    public function export() {
        require 'vendor/autoload.php';
            //Создаем экземпляр класса электронной таблицы
        $spreadsheet = new Spreadsheet();
            //Получаем текущий активный лист
        $sheet = $spreadsheet->getActiveSheet();
            // Записываем в ячейку A1 данные
        $sheet->setCellValue('A1', 'Hello my Friend!');
        $writer = new Xlsx($spreadsheet);
            //Сохраняем файл в текущей папке, в которой выполняется скрипт.
            //Чтобы указать другую папку для сохранения.
            //Прописываем полный путь до папки и указываем имя файла
        try {
            $writer->save('hello.xlsx');
        } catch
            (\PhpOffice\PhpSpreadsheet\Writer\Exception $e) {
        }
    }

}