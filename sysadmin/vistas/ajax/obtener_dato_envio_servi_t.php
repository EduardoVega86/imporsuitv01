<?php
require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";

$id_pedido = $_POST['id_pedido'];
$ciudad = $_POST['ciudad'];
if (isset($id_pedido)) {
    $sql = "SELECT tienda FROM `facturas_cot` WHERE `id_pedido` = '$id_pedido'";
    $result = mysqli_query($conexion, $sql);
    $tienda = mysqli_fetch_array($result);
    $tienda = $tienda['tienda'];

    $data = array(
        "tienda" => $tienda,
        "ciudad" => $ciudad
    );
    $data = json_encode($data);
    //iniciar curl
    $ch = curl_init();
    //establecer la URL y otras opciones apropiadas
    curl_setopt($ch, CURLOPT_URL, "../ajax/obtener_dato_envio_servi.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //capturar la URL y pasarla al navegador
    $result = curl_exec($ch);
    //cerrar curl
    curl_close($ch);
    echo $result;
} else {
    echo "Error al obtener el id del pedido";
}
