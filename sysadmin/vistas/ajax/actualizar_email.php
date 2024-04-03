<?php

include("../db.php");
include("../php_conexion.php");
$get_datos = json_decode(file_get_contents('php://input'), true);

if (!empty($get_datos)) {
    $email = $get_datos['email'];
    // Corrección en la consulta SQL, cerrando la comilla simple
    $sql = "UPDATE users SET email_users = '$email' WHERE id_users = '1'";
    $resultado = mysqli_query($conexion, $sql);
    if ($resultado) {
        echo json_encode(array(
            "email" => $email,
            "status" => "actualizado"
        ));
    } else {
        echo json_encode(array(
            "email" => $email,
            "status" => "noactualizado"
        ));
    }
} else {
    $sql = "SELECT email_users FROM users WHERE id_users = '1'";
    $resultado = mysqli_query($conexion, $sql);
    $rw = mysqli_fetch_array($resultado);
    $email = $rw['email_users'];
    if ($email === "root@admin.com") {
        // Corrección en cómo se devuelve el JSON
        echo json_encode(array(
            "email" => $email,
            "status" => "cambio"
        ));
    } else {
        // Corrección en cómo se devuelve el JSON
        echo json_encode(array(
            "email" => $email,
            "status" => "nocambio"
        ));
    }
}
