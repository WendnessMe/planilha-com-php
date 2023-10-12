<?php

require __DIR__ . '/vendor/autoload.php';

use WendnessMe\Calc\Sheet;
use WendnessMe\Calc\Request;

$request = new Request();
// $url = 'https://dados.iffarroupilha.edu.br/api/v1/alunos.json?ano_ingresso=2019&nivel=G';
$sheetName = "Alunos 2018";
$year = 2018;
$data = $request->getStudents($year);
$cells = $request->getCells(count($data));

$sheet = new Sheet();
$sheet->createSheet($data, $cells, $year, $sheetName);
