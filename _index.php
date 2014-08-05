<?php

include_once './functions.php';
$arquivo = "";
$ler = file('./ce0919.txt');
foreach ($ler as $linha) {
  $linha = cleanString2($linha);

  if (is_numeric($linha[0])) {


    for ($i = 0; $i <= 15; $i++) {
      $arquivo .= $linha[$i];
    }

    $arquivo .= " ";

    for ($i = 16; $i <= 40; $i++) {
      $arquivo .= $linha[$i];
    }

    for ($i = 42; $i <= 46; $i++) {
      $arquivo .= $linha[$i];
    }
    $arquivo .= " ";

    for ($i = 47; $i <= 48; $i++) {
      $arquivo .= $linha[$i];
    }

    for ($i = 50; $i <= 53; $i++) {
      $arquivo .= $linha[$i];
    }

    for ($i = 56; $i <= 100; $i++) {
      $arquivo .= $linha[$i];
    }

    for ($i = 99; $i <= 136; $i++) {
      $arquivo .= $linha[$i];
    }
  } else if (is_numeric($linha[50])) {
    $arquivo .= "                                                  ";
    #for ($i = 42; $i <= 51; $i++) {
    #  $arquivo .= $linha[$i];
    #}
    $arquivo .= $linha[50] . $linha[51];

    for ($i = 54; $i <= 100; $i++) {
      $arquivo .= $linha[$i];
    }

    for ($i = 99; $i <= 136; $i++) {
      $arquivo .= $linha[$i];
    }
  } else {
    $arquivo .= $linha;
  }
}

unlink("./estoque.txt");

$fp = fopen("./estoque.txt", "a");
$escreve = fwrite($fp, $arquivo);
fclose($fp);
?>
