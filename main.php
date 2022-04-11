<?php
require 'vendor/autoload.php';
require 'apiRequest.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$ano = readline("Qual o ano de ingresso?\n");

if (!empty($ano)) {
  echo "Preenchido de prima\n";
  $quantidade = readline("Quantos alunos?\n");
  if (!empty($quantidade)) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $docName = readline("Insira o nome para salvar o documento:\n");

    $sheet->setCellValue('A1', 'Ordem');
    $sheet->setCellValue('B1', 'Nome');
    $sheet->setCellValue('C1', 'Contato');
    $sheet->setCellValue('D1', 'Curso');
    $sheet->setCellValue('E1', 'Ano De Ingresso');

    $nomes = getByYear($ano, $quantidade, 0);
    $nomes = getByYear($ano, $quantidade, 0);

    // **
    $cells = array();
    $cellFinal = array();
    if ($quantidade > 100) {
      $new = $quantidade / 100;
      for ($i = 0; $i < $new; $i++) {
        $cellObj = getCell(100);
        $cellArr = (array) $cellObj;
        $cellValue = $cellArr['values'];
        array_push($cells, $cellValue);
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
    } else {
      for ($i = 0; $i < $quantidade; $i++) {
        $cellObj = getCell($quantidade);
        $cellFinal[] = $cellObj->values[$i];
      }
    }

    $cursos = getCourses($ano, $quantidade, 0);
    $cursosTt = array();
    $ordem = array();
    $anoIn = array();
    for ($i = 0; $i < $quantidade; $i++) {
      // **
      if ($cursos[$i] == NULL) {
        $rand = rand(0, $i);
        $cursos[$i] = $cursos[$rand];
      }
      $cursosTt[] = strstr($cursos[$i], " ");
      $ordem[] = $i + 1;
      array_push($anoIn, $ano);
    }

    $cellsColumn = array_chunk($cellFinal, 1);
    $sheet->fromArray($cellsColumn, NULL, "C2");
    $anosColumn = array_chunk($anoIn, 1);
    $sheet->fromArray($anosColumn, NULL, 'E2');
    $ordemColumn = array_chunk($ordem, 1);
    $sheet->fromArray($ordemColumn, NULL, 'A2');
    $columnArray = array_chunk($nomes, 1);
    $sheet->fromArray($columnArray, NULL, 'B2');
    $columnCursos = array_chunk($cursosTt, 1);
    $sheet->fromArray($columnCursos, NULL, 'D2');

    if (!empty($docName)) {
      $writer = new Xlsx($spreadsheet);
      $writer->save($docName);
    } else {
      do {
        $docName = readline("Por favor, insira um nome para o documento:\n");
      } while (empty($docName));
    }
  } else {
    do {
      $quantidade = readline("Por favor, insira quantos alunos deseja inserir na planilha:\n");
    } while (empty($quantidade));
  }
} else {
  do {
    $ano = readline("Por favor, insira um ano de ingresso:\n");
  } while (empty($ano));
  if (!empty($ano)) {
    echo "Preenchido depois de mandar vazio\n";
  }
}
