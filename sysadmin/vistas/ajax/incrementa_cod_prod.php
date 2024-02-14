<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
$query_id = mysqli_query($conexion, "SELECT RIGHT(codigo_producto,6) as codigo FROM productos
  ORDER BY codigo_producto DESC LIMIT 1")
  or die('error ' . mysqli_error($conexion));
$count = mysqli_num_rows($query_id);

if ($count != 0) {

  $data_id = mysqli_fetch_assoc($query_id);
  // seprara el codigo de la factura para incrementar

  $codigo  = $data_id['codigo'];
  if (preg_match('/[A-Za-z]/', $codigo)) {

    $letra = preg_replace('/[^A-Za-z]+/', '', $codigo);
    $numero = preg_replace('/[^0-9]+/', '', $codigo);
    $numero = $numero + 1;
    $letra = strtoupper($letra);
    $letra = str_pad($letra, 3, "0", STR_PAD_RIGHT);
    $numero = str_pad($numero, 3, "0", STR_PAD_LEFT);
    $codigo = $letra . $numero;
  } else {
    $codigo = $codigo + 1;
  }
} else {
  $codigo = 1;
}

$buat_id = str_pad($codigo, 5, STR_PAD_LEFT);
$codigo  = "$buat_id";

echo '<input type="text" class="form-control" autocomplete="off" id="codigo" value="' . $codigo . '" name="codigo" >';
