<?php
//echo 'asd';
@define('DB_HOST', 'localhost'); //DB_HOST:  generalmente suele ser "127.0.0.1"
@define('DB_USER', 'root'); //Usuario de tu base de datos
@define('DB_PASS', ''); //Contrasena del usuario de la base de datos
@define('DB_NAME', 'prueba_imporsuit'); //Nombre de la base de datos


$host = 'localhost';
$usuario = 'root';
$contrasena= '';
$base_de_datos = 'prueba_imporsuit';

$info = [
    'DB_HOST' => 'localhost',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    'DB_NAME' => 'prueba_imporsuit'
];

// Convertir el array asociativo a JSON
$json_info = json_encode($info, JSON_PRETTY_PRINT);
