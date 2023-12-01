<?php
$url = $_SERVER['HTTP_HOST']; // Parsea la URL
$parsedUrl = parse_url($url);
// Obtiene el fragmento que necesitas
$primeraParte = $parsedUrl['path'];
// Verifica si es un subdominio
$subdominioComponentes = explode('.', $primeraParte);
if (count($subdominioComponentes) > 2) {
    // Si es un subdominio, obtenemos el subdominio
    $primeraParte = $subdominioComponentes[0];
} else {
    // Si no es un subdominio, obtenemos el dominio
    $primeraParte = $subdominioComponentes[0];
}
$user = "imporsuit_" . $primeraParte;
@define('DB_HOST', 'localhost'); //DB_HOST:  generalmente suele ser "127.0.0.1"
@define('DB_USER', $user); //Usuario de tu base de datos
if ($url == 'imporshop.imporsuit.com/') {
    @define('DB_PASS', 'E?c7Iij&885Y'); //Contraseña del usuario de la base de datos
} else {
    @define('DB_PASS', $user); //Contraseña del usuario de la base de datos
}
@define('DB_NAME', $user); //Nombre de la base de datos

$host = 'localhost';
$usuario = $user;
if ($url == 'imporshop.imporsuit.com/') {
    $contrasena = 'E?c7Iij&885Y';
} else {
    $contrasena = $user;
}
$base_de_datos = $user;
