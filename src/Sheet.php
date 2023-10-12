<?php

namespace WendnessMe\Calc;

use WendnessMe\Calc\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Sheet
{
  public function createSheet($data, $cells, $year, $sheetName)
  {
    $names = [];
    $courses = [];

    for ($i = 0; $i < count($data); $i++) {
      $names[] = $data[$i]['name'];
      $courses[] = $data[$i]['course'];
    }

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    // $docName = readline("Insira o nome para salvar o documento:\n");

    $sheet->setCellValue('A1', 'Ordem');
    $sheet->getColumnDimension('A')->setAutoSize(true);
    $sheet->getStyle('A1')->getFont()->setBold(true);

    $sheet->setCellValue('B1', 'Nome');
    $sheet->getColumnDimension('B')->setAutoSize(true);
    $sheet->getStyle('B1')->getFont()->setBold(true);

    $sheet->setCellValue('C1', 'Contato');
    $sheet->getColumnDimension('C')->setAutoSize(true);
    $sheet->getStyle('C1')->getFont()->setBold(true);

    $sheet->setCellValue('D1', 'Curso');
    $sheet->getColumnDimension('D')->setAutoSize(true);
    $sheet->getStyle('D1')->getFont()->setBold(true);

    $sheet->setCellValue('E1', 'Ano De Ingresso');
    $sheet->getColumnDimension('E')->setAutoSize(true);
    $sheet->getStyle('E1')->getFont()->setBold(true);

    $columnArray = array_chunk($names, 1);
    $sheet->fromArray($columnArray, NULL, 'B2');

    $columnCursos = array_chunk($courses, 1);
    $sheet->fromArray($columnCursos, NULL, 'D2');

    $cellsColumn = array_chunk($cells, 1);
    $sheet->fromArray($cellsColumn, NULL, "C2");

    for ($i = 0; $i < count($data); $i++) {
      $sheet->setCellValue('A' . ($i + 1), ($i + 1));

      $sheet->setCellValue('E' . ($i + 1), $year);
    }

    $writer = new Xlsx($spreadsheet);
    $writer->save($sheetName . ".xlsx");
  }
}
