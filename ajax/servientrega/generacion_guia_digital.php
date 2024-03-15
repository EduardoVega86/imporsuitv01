<?php

// URL del servicio web
$url = "https://181.39.87.158:7777/api/GuiaDigital/[180000085,'USUARIO','CONTRASEÑA']";

// Inicializar cURL
$ch = curl_init();

// Configurar opciones de cURL para la solicitud GET
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Omitir la verificación de SSL (NO recomendado para producción)
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

// Ejecutar la solicitud y obtener la respuesta
$response = curl_exec($ch);

// Verificar si ocurrió algún error
if (curl_errno($ch)) {
    throw new Exception(curl_error($ch));
}

// Cerrar la sesión cURL
curl_close($ch);

// La respuesta asumida es una cadena base64 de la imagen
$base64String = $response;

// Para visualizar la imagen, especificamos el tipo de contenido correcto.
// Asegúrate de no tener ningún echo o var_dump antes de este punto para evitar errores de "headers already sent".
header('Content-Type: image/png');

// Decodificar la cadena base64 y mostrar la imagen
echo base64_decode($base64String);
?>

