<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
/*-------------------------
Autor: Eduardo Vega
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";
require_once "../funciones_destino.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Ventas";

if (isset($_POST['factura'])) {
    $sql_command = "SELECT * FROM guia_laar g inner join facturas_cot f on g.id_pedido = f.id_factura_origen and g.tienda_venta = f.tienda WHERE g.id_pedido = '" . $_POST['factura'] . "'";
    $result = mysqli_query($conexion, $sql_command);
    $row = mysqli_fetch_array($result);
    $id_factura = $row['id_factura'];
    $id_cliente = $row['id_cliente'];
}
