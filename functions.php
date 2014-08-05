<?php
$GLOBALS['normalizeChars'] = array(
    'Š' => 'S', 'š' => 's', 'Ð' => 'Dj', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
    'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
    'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U',
    'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
    'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
    'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u',
    'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f', 'ŕ' => 'r'
);

function cleanString($toClean) {
  $toClean = str_replace(' ', '_', $toClean);
  $toClean = str_replace('&', 'e', $toClean);
  $toClean = str_replace('"', '_', $toClean);
  $toClean = str_replace('!', '_', $toClean);
  $toClean = str_replace('#', '_', $toClean);
  $toClean = str_replace('$', '_', $toClean);
  $toClean = str_replace('%', '_', $toClean);
  $toClean = str_replace('*', '_', $toClean);
  $toClean = str_replace('(', '_', $toClean);
  $toClean = str_replace(')', '_', $toClean);
  $toClean = str_replace('+', '_', $toClean);
  $toClean = str_replace('-', '_', $toClean);
  $toClean = str_replace('|', '_', $toClean);
  $toClean = str_replace('?', '_', $toClean);
  $toClean = str_replace("'", '_', $toClean);
  $toClean = strtr($toClean, $GLOBALS['normalizeChars']);
  return str_replace("'", '_', $toClean);
//    return strtr($toClean, $GLOBALS['normalizeChars']);
}

function cleanString2($toClean) {
//  $toClean = str_replace('&', 'e', $toClean);
//  $toClean = str_replace('"', '_', $toClean);
//  $toClean = str_replace('!', '_', $toClean);
//  $toClean = str_replace('#', '_', $toClean);
//  $toClean = str_replace('$', '_', $toClean);
//  $toClean = str_replace('%', '_', $toClean);
//  $toClean = str_replace('*', '_', $toClean);
//  $toClean = str_replace('(', '_', $toClean);
//  $toClean = str_replace(')', '_', $toClean);
//  $toClean = str_replace('+', '_', $toClean);
//  $toClean = str_replace('|', '_', $toClean);
//  $toClean = str_replace('?', '_', $toClean);
  $toClean = strtr($toClean, $GLOBALS['normalizeChars']);

  return str_replace("'", '_', $toClean);
//    return strtr($toClean, $GLOBALS['normalizeChars']);
}

function fullUPPER($metin) {
  return mb_convert_case(str_replace('i', 'I', $metin), MB_CASE_UPPER, "UTF-8");
}

function date2dbase($date) {
  $explode = explode('/', $date);
  list($dia, $mes, $ano) = $explode;
  return $ano . "-" . $mes . "-" . $dia;
}

function date2html($date) {
  $explode = explode('-', $date);
  list($ano, $mes, $dia) = $explode;
  return $dia . "/" . $mes . "/" . $ano;
}

function isAdmin() {
  include_once DEM_INC . '/bib/php/connection.php';
  $mysql = new connection();
  $key = Descodifica($_SESSION["JNn8j"]);
  $result = $mysql->Sql("SELECT * FROM `users` WHERE `key` = '$key'");
  $row = mysql_fetch_object($result);
  $type = $row->type;

  if ($type == 1) {
    return true;
  } else {
    ?>
    <script type="text/javascript">
      alert("Você não tem permissão para estar aqui !!!");
      window.location = "<?php echo DEM_HOST . "/painel_home.php"; ?>";
    </script>
    <?php
  }
}

function isPermission($module) {
  include_once DEM_INC . '/bib/php/connection.php';
  $mysql = new connection();
  $key = Descodifica($_SESSION["JNn8j"]);

  $result = $mysql->Sql("SELECT * FROM `module_user` WHERE `module` = '$module' AND `key_user` = '$key'");
  if (mysql_num_rows($result) == 1) {
    return true;
  } else {
    ?>
    <script type="text/javascript">
      alert("Você não tem permissão para estar aqui !!!");
      window.location = "<?php echo DEM_HOST . "/painel_home.php"; ?>";
    </script>
    <?php
  }
}
?>