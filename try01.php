<?php
require 'vendor/autoload.php';
require 'apiRequest.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
// $i = 2;
// $sheet->setCellValue('A' . $i, 'Hello World!');

$quantos = 267;
$ano = 2019;
$nomes = getByYear($ano, $quantos, 0);
$cursos = getCourses($ano, $quantos, 0);
$cursosTt = array();

$cells = array();
$celulares = array();
$cellFinal = array();
$cells1 = array();
if ($quantos > 100) {
  $new = $quantos / 100;
  for ($i = 0; $i < $new; $i++) {
    $hun = 100;
    $cellObj = getCell($hun);
    $cellArr = (array) $cellObj;
    $cellValue = $cellArr['values'];
    array_push($cells, $cellValue);
    //    $cellFinal = array_push($celulares, $cells);
    //    $cells[] = $cellObj->values[$i];
    //    $cellFinal = array_merge($celulares, $cells);
  }
  $cellQt = count($cells);
  $cellI = $cellQt * 100;
  for ($i = 0; $i < $cellQt; $i++) {
    for ($in = 0; $in < 100; $in++) {
      $cellFinal[] = $cells[$i][$in];
    }
  }

  if (is_float($new)) {
    $whole = floor($new);
    $fraction = $new - $whole;
    $fraction = $fraction * 100;
    for ($i = 0; $i < $fraction; $i++) {
      $cellObj = getCell($fraction);
      $cellFinal[] = $cellObj->values[$i];
    }
  }
}
// print_r($cells);
// echo $cellQt;
// echo $cells[0]->values[0];
// print_r($cellFinal);

// print_r($cellFinal);

/*
$cells = getCell($quantos);
$celulares = array();
 */

$sheet->setCellValue('A1', "Ordem");
$sheet->setCellValue('B1', 'Nome');
$sheet->setCellValue('C1', 'Contato');
$sheet->setCellValue('D1', 'Curso');
$sheet->setCellValue('E1', 'Ano De Ingresso');

for ($i = 0; $i < $quantos; $i++) {
  if ($cursos[$i] == NULL) {
    $rand = rand(0, $i);
    $cursos[$i] = $cursos[$rand];
  }
  $cursosTt[] = strstr($cursos[$i], ' ');
}

$ordem = array();
$anos = array();
for ($i = 0; $i < $quantos; $i++) {
  $ordem[] = $i + 1;
  array_push($anos, '2019');
}

/*
for ($i = 0; $i < $quantos; $i++) {
  $celulares[] = $cells->values[$i];
}
print_r($celulares);
 */
$cellsColumn = array_chunk($cellFinal, 1);
$sheet->fromArray($cellsColumn, NULL, "C2");

$anosColumn = array_chunk($anos, 1);
$sheet->fromArray($anosColumn, NULL, 'E2');
$ordemColumn = array_chunk($ordem, 1);
$sheet->fromArray($ordemColumn, NULL, 'A2');
$columnArray = array_chunk($nomes, 1);
$sheet->fromArray($columnArray, NULL, 'B2');
$columnCursos = array_chunk($cursosTt, 1);
$sheet->fromArray($columnCursos, NULL, 'D2');

/*
for ($i = 0; $i < 100; $i++) {
  //  It started counting from 1, ignoring the key 0 on the array
  //  $sheet->setCellValue('A' . $i, $nomes[$i]);

  /*
  $count = 2;
  $sheet->setCellValue('A' . $i, $i);
  $sheet->setCellValue('B' . $i, $nomes[$i]);
  $count = $i;
   */

/*
  if ($i == 0) {
    $sheet->setCellValue('A1', $nomes[$i]);
  } else {
    $sheet->setCellValue('A' . $i, $nomes[$i]);
  }
   */
/*
  for ($i = 0; $i == 0; $i++) {
    $sheet->setCellValue('A1', $nomes[$i]);
    echo "Loop bugado";
    exit;
  }
  $sheet->setCellValue('A' . $i, $nomes[$i]);
}
 */

$writer = new Xlsx($spreadsheet);
$writer->save('Alunos01.xlsx');
