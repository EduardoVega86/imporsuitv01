<?php
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Inicia Control de Permisos

$data = file_get_contents("php://input");
parse_str($data, $datos);
$estado = $datos['estado'];
$guia = $datos['guia'];

$sql = "UPDATE guia_laar SET estado_guia = '$estado' WHERE guia_laar = '$guia'";

$result = mysqli_query($conexion, $sql);

if ($result) {
    echo "1";
} else {
    echo "0";
}
