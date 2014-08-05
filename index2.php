<?php

$arquivo = "";
$ler = file('./estoque.txt');
foreach ($ler as $linha) {
  if ((is_numeric($linha[0])) && ($linha[44] != "U")) {
    echo $linha . "<br />";
    for ($i = 0; $i <= 43; $i++) {
      $arquivo .= $linha[$i];
    }
//    $arquivo .= " ";

    for ($i = 44; $i <= 200; $i++) {
      $arquivo .= $linha[$i];
    }
  } else {
    $arquivo .= $linha;
  }
}

unlink("./estoque2.txt");

$fp = fopen("./estoque2.txt", "a");

$escreve = fwrite($fp, $arquivo);
fclose($fp);
?>