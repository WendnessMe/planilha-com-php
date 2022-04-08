<?php
require 'apiRequest.php';

$endpoint = 2019;
$count = 100;
$nomes = getByYear(2019, 10, 0);

$url = 'https://dados.iffarroupilha.edu.br/api/v1/alunos.json?nivel=G&ano_ingresso=' . $endpoint;
$response = json_decode(file_get_contents($url));
$nomeArr = $response->data;
$nomesTt = array_slice($nomeArr, 0, 10);
$nomeShow = $nomesTt[0]->nome;
// echo $nomeShow . "</br>";
// print_r($nomesTt);

/*
for ($i = 0; $i <= $count; $i++) {
  $nomesArr = $response->data;
  $nomesTt = array_slice($nomesArr, 0, $count);
  $nomes[] = $nomesTt[$i]->nome;
}
 */
