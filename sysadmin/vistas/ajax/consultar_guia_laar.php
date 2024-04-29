<?php

require_once "../db.php";
require_once "../funciones.php";
require_once "../php_conexion.php";

$guia = $_POST['guia'];

$consulta = "SELECT * FROM guia_laar WHERE guia_laar = '$guia'";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_array($resultado);
    $respuesta = array(
        'guia' => $fila['guia_laar'],
        'fecha' => $fila['fecha'],
        'hora' => $fila['hora'],
        'destino' => $fila['destino'],
        'observaciones' => $fila['observaciones'],
        'estado' => $fila['estado']
    );
} else {
    $respuesta = array(
        'guia' => '',
        'fecha' => '',
        'hora' => '',
        'destino' => '',
        'observaciones' => '',
        'estado' => ''
    );
}
