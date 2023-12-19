<?php

$data = file_get_contents("php://input");

parse_str($data, $datos);

require_once "../db.php";
require_once "../php_conexion.php";

print_r($datos);
