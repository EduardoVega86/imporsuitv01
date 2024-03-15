<?php

$url = 'https://181.39.87.158:8021/api/guiawebs/';

// Los datos que vas a enviar en formato JSON
$data = array(
    "id_tipo_logistica" => 1,
    "detalle_envio_1" => "",
    "detalle_envio_2" => "",
    "detalle_envio_3" => "",
    "id_ciudad_origen" => 1,
    "id_ciudad_destino" => 42,
    "id_destinatario_ne_cl" => "001dest",
    "razon_social_desti_ne" => "prueba de api s.a",
    "nombre_destinatario_ne" => "gustavo andres",
    "apellido_destinatar_ne" => "tecnologia matriz",
    "direccion1_destinat_ne" => "panama 306 y thomas y martinez",
    "sector_destinat_ne" => "",
    "telefono1_destinat_ne" => "3732000 ext 4732",
    "telefono2_destinat_ne" => "",
    "codigo_postal_dest_ne" => "",
    "id_remitente_cl" => "001remi",
    "razon_social_remite" => "servientrega ecuador s.a",
    "nombre_remitente" => "gustavo",
    "apellido_remite" => "villalba lopez",
    "direccion1_remite" => "panama 306 y thomas y martinez",
    "sector_remite" => "",
    "telefono1_remite" => "123156",
    "telefono2_remite" => "",
    "codigo_postal_remi" => "",
    "id_producto" => 2,
    "contenido" => "laptop",
    "numero_piezas" => 1,
    "valor_mercancia" => 0,
    "valor_asegurado" => 0,
    "largo" => 0,
    "ancho" => 0,
    "alto" => 0,
    "peso_fisico" => 0.5,
    "login_creacion" => "impor.comex",
    "password" => "123456"
);

// Convertir los datos al formato JSON
$jsonData = json_encode($data);

// Inicializar cURL
$ch = curl_init($url);

// Configura opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Ignora la verificación de SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

// Configurar las opciones de cURL para la solicitud POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Omitir la verificación de SSL si es necesario (no recomendado para producción)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Ejecutar la solicitud
$response = curl_exec($ch);

// Verificar si ocurrió algún error durante la solicitud
if(curl_errno($ch)){
    throw new Exception(curl_error($ch));
}

// Cerrar la sesión cURL
curl_close($ch);

// Mostrar la respuesta
echo $response;

?>