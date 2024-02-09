<?php

require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos

$sql_sin_guia = "SELECT COUNT(*) as no_guia FROM facturas_cot where (guia_enviada is null or guia_enviada = 0) and provincia !=17 and provincia!=22;";
$result_sin_guia = mysqli_query($conexion, $sql_sin_guia);
$row_sin_guia = mysqli_fetch_array($result_sin_guia);
$no_guia = $row_sin_guia['no_guia'];
