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

    $arquivo .= "  ";

    for ($i = 16; $i <= 41; $i++) {
      $arquivo .= $linha[$i];
    }

    $arquivo .= "  ";

    for ($i = 42; $i <= 51; $i++) {
      $arquivo .= $linha[$i];
    }

    for ($i = 54; $i <= 136; $i++) {
      $arquivo .= $linha[$i];
    }
  } else if (is_numeric($linha[48])) {
    $arquivo .= "                                            ";
    for ($i = 42; $i <= 51; $i++) {
      $arquivo .= $linha[$i];
    }

    for ($i = 54; $i <= 136; $i++) {
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
