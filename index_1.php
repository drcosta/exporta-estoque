<?php

include_once './functions.php';
$arquivo = "";

$arquivo = "------------------------------------------------------------------------------------------------------------------------------------\n";
$arquivo .= "Ipanema Agricola S.A.                            Saldo Fisico dos Itens - 31/05/2014                                   Página:     1\n";
$arquivo .= "-------------------------------------------------------------------------------------------------------------- 11/06/2014 - 06:55:34\n\n";
$arquivo .= "Item             Descrição                  Un Ob Est Dep Refer.      Conc/PPM    Lote       Validade Localiza            Quantidade\n";
$arquivo .= "------------------------------------------------------------------------------------------------------------------------------------\n";
$counter = 6;
$pag = 1;

$it = "";
$total = "";

$ler = file('./ce0919.csv');
foreach ($ler as $linha) {
  $explode = explode(';', $linha);
  list($item, $estabelecimento, $deposito, $localizacao, $lote, $referencia, $validade, $un, $qtd_liquida, $qtd_alocada, $qtd_producao, $qtd_venda, $familia, $grp_estoque, $fator, $ob, $descricao) = $explode;

  $descricao = cleanString2($descricao);
  if (is_numeric($item)) {

    if ($counter == 128) {
      $counter = 6;
      $pag++;

      if ($pag > 10) {
        $pag = " " . $pag;
      } else {

      }

      $arquivo .= "-----------------------------------------------------------------------------------------------DATASUL -  - CE0919RP - V:2.00.00.029\n";
      $arquivo .= "------------------------------------------------------------------------------------------------------------------------------------\n";
      $arquivo .= "Ipanema Agricola S.A.                            Saldo Fisico dos Itens - 31/05/2014                                   Página:    $pag\n";
      $arquivo .= "-------------------------------------------------------------------------------------------------------------- 11/06/2014 - 06:55:34\n\n";
      $arquivo .= "Item             Descrição                  Un Ob Est Dep Refer.      Conc/PPM    Lote       Validade Localiza            Quantidade\n";
      $arquivo .= "------------------------------------------------------------------------------------------------------------------------------------\n";
    }

    if ($it != $item) {

      $arquivo .= "                                                                                          Total do Item :                     $total \n\n";
      $total = 0;
      $it = $item;
    }

    if ($it == $item) {
      if (strlen($item) == 5) {
        $arquivo .= $item . "            ";
      } else if (strlen($item) == 6) {
        $arquivo .= $item . "           ";
      }
    } else {
      if (strlen($item) == 5) {
        $arquivo .= $item . "            ";
      } else if (strlen($item) == 6) {
        $arquivo .= $item . "           ";
      }

      $descricao = utf8_decode($descricao);
      $desc = "";
      for ($i = 0; $i <= 25; $i++) {
        $desc .= str_replace("\n", " ", $descricao[$i]);
      }

      for ($i = strlen($desc); $i <= 25; $i++) {
        $desc .= " ";
      }

      $arquivo .= $desc . " ";

      $arquivo .= "UN ";

      if ($ob == "Ativo") {
        $ob = "1";
      } else if ($ob == "Totalmente Obsoleto") {
        $ob = "4";
      }

      $arquivo .= " " . $ob . " ";
    }





    $arquivo .= $estabelecimento . "  ";

    $arquivo .= $deposito . " ";

    $arquivo .= "              ";

    $arquivo .= $fator . " ";

    $arquivo .= "                                       ";

    $quant = "";
    for ($i = strlen($qtd_liquida); $i <= 13; $i++) {
      $quant .= " ";
    }

    $total += str_replace(',', '.', $qtd_liquida);

    $arquivo .= $quant . $qtd_liquida;

    $arquivo .= "\n";
    $counter++;
  }
}

unlink("./estoque.txt");

$fp = fopen("./estoque.txt", "a");
$escreve = fwrite($fp, $arquivo);
fclose($fp);
?>