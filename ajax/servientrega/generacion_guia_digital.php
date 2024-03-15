<?php

// URL del servicio web
$url = "https://181.39.87.158:7777/api/GuiaDigital/[31030,'impor.comex','123456']";

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

// Decodificar la respuesta JSON para obtener la cadena base64 de la imagen
$responseData = json_decode($response, true);
$base64String = $responseData['archivoEncriptado'];

echo '<img src="data:image/jpg;base64,' . $base64String . '" style="max-width: 100%; height: auto;">';

echo $base64String;
// Asegúrate de que tienes la cadena base64 de la imagen
if ($base64String) {
    // Mostrar la imagen
    echo '<img src="data:image/jpg;base64,' . $base64String . '" />';
} else {
    echo 'No se pudo obtener la imagen.';
}
?>
