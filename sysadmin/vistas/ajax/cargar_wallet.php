<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";

//Obtenemos la fecha actual
$fecha = date('Y-m-d');
$fecha_desde = $_POST['fecha_desde'];

//buscamos los datos de la tabla wallet

$consulta = "SELECT * 
    FROM guia_laar 
    WHERE 
        fecha BETWEEN '$fecha_desde 00:00:00' AND '$fecha 23:59:59' 
        AND guia_laar != '' 
        AND (
            estado_guia = 7 
            OR estado_guia = 9 
            OR estado_guia >= 300 AND estado_guia <= 505
        )
    ORDER BY fecha DESC";
$resultado = mysqli_query($conexion, $consulta);
$guias = array();

while ($row = mysqli_fetch_array($resultado)) {
    $guias[] = $row['guia_laar'];
}

echo json_encode($guias);
