<?php

require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos

$data = json_decode(file_get_contents("php://input"));


echo $data;
