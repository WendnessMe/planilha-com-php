<?php
header('Content-type: text/html; charset=utf-8');
function getCell($endpoint)
{
  $url = "https://geradorbrasileiro.com/api/faker/celular?limit=" . $endpoint;
  $response = file_get_contents($url);
  $cellObj = json_decode($response);
  return $cellObj;
}
/*
$celular = getCell(10);
$celArr = array();
for ($i = 0; $i <= 10; $i++) {
  echo $celular[$i] . "</br>";
}
 */

function getByYear($endpoint, $count, $fromWhere)
{
  $url = "https://dados.iffarroupilha.edu.br/api/v1/alunos.json?nivel=G&ano_ingresso=" . $endpoint;
  $response = file_get_contents($url);
  $nameObj = json_decode($response);
  $names = array();

  for ($i = 0; $i < $count; $i++) {
    $nameArr = $nameObj->data;
    $nameTt = array_slice($nameArr, $fromWhere, $count);
    $names[] = $nameTt[$i]->nome;
  }
  return $names;
}

function getCourses($endpoint, $count, $fromWhere)
{
  $url = "https://dados.iffarroupilha.edu.br/api/v1/alunos.json?nivel=G&ano_ingresso=" . $endpoint;
  $response = file_get_contents($url);
  $courseObj = json_decode($response);
  $courses = array();

  for ($i = 0; $i < $count; $i++) {
    $courseArr = $courseObj->data;
    $courseTt = array_slice($courseArr, $fromWhere, $count);
    $courses[] = $courseTt[$i]->links->id_curso->title;
  }
  return $courses;
}
