<?php
$get_data = json_decode(file_get_contents('php://input'), true);

$contacto = $get_data['nombre'];
$whatsapp = $get_data['telefono'];
$email = $get_data['correo'];
$url_imporsuit = $get_data['enlace'];



$marketplace_conexion = mysqli_connect('localhost', 'imporsuit_marketplace', 'imporsuit_marketplace', 'imporsuit_marketplace');

$sql_insert = "INSERT INTO plataformas (contacto, whatsapp, email, url_imporsuit) VALUES ('$contacto', '$whatsapp', '$email', '$url_imporsuit')";

$query_insert = mysqli_query($marketplace_conexion, $sql_insert);


if ($query_insert) {
    $response = array(
        "status" => "actualizado",
        "message" => "Información actualizada"

    );
    echo json_encode($response);
} else {
    $response = array(
        "status" => "error",
        "message" => "Error al actualizar la información"

    );
    echo json_encode($response);
}
