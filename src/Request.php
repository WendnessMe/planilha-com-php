<?php

namespace WendnessMe\Calc;

class Request
{
  public function getStudents($year)
  {
    $url = 'https://dados.iffarroupilha.edu.br/api/v1/alunos.json?ano_ingresso=' . $year . '&nivel=G';
    $response = [];
    $json = file_get_contents($url);

    if ($json) {
      $jsonObj = json_decode($json);
      foreach ($jsonObj->data as $student) {
        $response[] = [
          'name' => $student->nome,
          'course' => explode(': ', $student->links->id_curso->title)[1],
        ];
      }

      return $response;
    } else {
      $response = [
        'error' => 'Ops! Something went wrong...',
      ];

      return $response;
    }
  }

  public function getCells($sQt)
  {
    if ($sQt > 100) {

      $url = "https://geradorbrasileiro.com/api/faker/celular?limit=100";
      $cellsJson = file_get_contents($url);
      $obj = json_decode($cellsJson);

      if ($obj) {
        $array = $obj->values;
        $cells = [];

        for ($offset = count($array); $offset < $sQt; $offset += 100) {
          $cellsJson = file_get_contents($url);
          $cellsObj = json_decode($cellsJson);

          $cells = array_merge($cells, $cellsObj->values);

          if (($sQt - count($cells)) % 100) {
            $remainder = ($sQt - count($cells)) % 100;
            $url = "https://geradorbrasileiro.com/api/faker/celular?limit=" . $remainder;
            $cellsJson = file_get_contents($url);
            $cellsObj = json_decode($cellsJson);

            $cells = array_merge($cells, $cellsObj->values);
            if (count($cells) == $sQt) {
              break;
            }
          }
        }
      }
      
      return $cells;

    } else {
      $url = "https://geradorbrasileiro.com/api/faker/celular?limit=" . $sQt;
      $cellsJson = file_get_contents($url);
      $obj = json_decode($cellsJson);

      return $obj;
    }
  }

  public function hi()
  {
    return "HI!";
  }
}
