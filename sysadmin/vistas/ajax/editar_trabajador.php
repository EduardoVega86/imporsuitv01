<?php

$get_data = file_get_contents("php://input");

$nombre = $_POST['nombre'];
$contacto = $_POST['contacto'];
$placa = $_POST['placa'];
$empresa = $_POST['empresa'];

$nombre = mysqli_real_escape_string($conexion, $nombre);
$contacto = mysqli_real_escape_string($conexion, $contacto);
$placa = mysqli_real_escape_string($conexion, $placa);
$empresa = mysqli_real_escape_string($conexion, $empresa);

$sql = "UPDATE trabajadores_envio SET nombre = '$nombre', contacto = '$contacto', placa = '$placa', empresa = '$empresa' WHERE id_trabajador = '$id_trabajador'";
if (mysqli_query($conexion, $sql)) {
    echo "ok";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}
