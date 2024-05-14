<?php
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos

$data = file_get_contents('php://input');

$json = json_decode($data, true);

$guia = $json['guia'];

$consulta = "SELECT * FROM detalle_novedad WHERE guia_novedad = '$guia'";
$result = $conexion->query($consulta);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo "0 results";
}
