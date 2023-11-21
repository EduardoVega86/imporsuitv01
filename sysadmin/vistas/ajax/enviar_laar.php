<?php
// Datos de usuario y contraseña
$usuario = "prueba.importshop.api";
$contrasena = "!mp0rt@sh@23";

require_once "../db.php";
require_once "../php_conexion.php";

//destino
$nombre_destino=$_POST['nombre_destino'];
$ciudad_entrega=$_POST['ciudad_entrega'];
$direccion=$_POST['direccion'];
$referencia=$_POST['referencia'];
$telefono=$_POST['telefono'];
$celular=$_POST['celular'];
$cod=$_POST['cod'];
$seguro=$_POST['seguro'];
$productos_guia=$_POST['productos_guia'];
$cantidad_total=$_POST['cantidad_total'];

//origen
$identificacionO= get_row('', '', 'id_origen', 1);
$provinciaO= get_row('', '', 'provinciaO', 1);
$ciudadO= get_row('', '', 'ciudadO', 1);
$nombreO= get_row('', '', 'nombreO', 1);
$direccionO= get_row('', '', 'direccion', 1);
$refenciaO= get_row('', '', 'referencia', 1);
$numeroCasaO= get_row('', '', 'numeroCasa', 1);
$telefonoO= get_row('', '', 'telefono', 1);
$celularO= get_row('', '', 'celular', 1);

$token_url = "https://api.laarcourier.com:9727/authenticate";

// Datos a enviar en formato JSON
$auth_data = json_encode(array('username' => $usuario, 'password' => $contrasena));

// Configuración de la solicitud cURL para obtener el token
$token_ch = curl_init($token_url);
curl_setopt($token_ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($token_ch, CURLOPT_POSTFIELDS, $auth_data);
curl_setopt($token_ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($token_ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($auth_data)
));

// Realizar la solicitud cURL para obtener el token
$token_response = curl_exec($token_ch);

// Verificar si hubo errores en la solicitud
if (curl_errno($token_ch)) {
    echo 'Error en la solicitud cURL para obtener el token: ' . curl_error($token_ch);
}

// Cerrar la conexión cURL
curl_close($token_ch);

// Procesar la respuesta del servicio web para obtener el token
if ($token_response) {
    $token_data = json_decode($token_response, true);
    $token = $token_data['token']; // Suponiendo que el token se encuentra en la respuesta
    // Ahora tenemos el token que debemos enviar en la cabecera Bearer
    // a otro servicio web
} else {
    echo 'No se recibió respuesta del servicio web para obtener el token';
}

// URL del servicio web al que deseas enviar los datos con el token
$destino_url = "https://api.laarcourier.com:9727/guias";

// Datos a enviar en formato JSON al servicio de destino
$datos_destino = array(
    "origen" => array(
        "identificacionO" => "1001995123",
        "ciudadO" => "201001001901",
        "nombreO" => "andres celleri",
        "direccion" => "vellanss y cipreses",
        "referencia" => "",
        "numeroCasa" => "",
        "postal" => "",
        "telefono" => "3960000",
        "celular" => "string"
    ),
    "destino" => array(
        "identificacionD" => "1760411569",
        "ciudadD" => "$ciudad",
        "nombreD" => "Jose",
        "direccion" => "El inca",
        "referencia" => "Frente al Aki Molineros",
        "numeroCasa" => "string",
        "postal" => "string",
        "telefono" => "0983722209",
        "celular" => "0983722209"
    ),
    "numeroGuia" => "1020",
    "tipoServicio" => "201202002002013",
    "noPiezas" => 1,
    "peso" => 2,
    "valorDeclarado" => 15,
    "contiene" => "DECODIFICADOR",
    "tamanio" => "",
    "cod" => false,
    "costoflete" => 4,
    "costoproducto" => 11,
    "tipocobro" => 0,
    "comentario" => "Guia de prueba",
    "fechaPedido" => "06/11/2023",
    "retorno" => array(
        "tipoServicio" => "201202002002013",
        "noPiezas" => 2,
        "peso" => 4,
        "contiene" => "",
        "comentario" => "",
        "tamanio" => ""
    ),
    "extras" => array(
        "Campo1" => "",
        "Campo2" => "",
        "Campo3" => ""
    )
);

// Configuración de la solicitud cURL para el servicio de destino
$ch = curl_init($destino_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($datos_destino));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $token // Agregar el token en la cabecera Bearer
));

// Realizar la solicitud cURL al servicio de destino
$response = curl_exec($ch);

// Verificar si hubo errores en la solicitud
if (curl_errno($ch)) {
    echo 'Error en la solicitud cURL para el servicio de destino: ' . curl_error($ch);
}

// Cerrar la conexión cURL
curl_close($ch);

// Procesar la respuesta del servicio de destino
if ($response) {
    $data = json_decode($response, true);
    // Puedes trabajar con los datos de respuesta aquí
    var_dump($data);
} else {
    echo 'No se recibió respuesta del servicio de destino';
}
?>
