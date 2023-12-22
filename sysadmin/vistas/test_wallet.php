<?php
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
require_once "../funciones.php"; //Contiene funcion que conecta a la base de datos
$api_laar = "https://api.laarcourier.com:9727/guias/";

$guias_laar = 'SELECT * FROM `guia_laar`WHERE guia_laar != "" and tienda_venta ="https://einzas2.imporsuit.com" ORDER BY `fecha` DESC';

$guias_laar = mysqli_query($conexion, $guias_laar);;
while ($rw = mysqli_fetch_assoc($guias_laar)) {
    print_r($rw);
}
