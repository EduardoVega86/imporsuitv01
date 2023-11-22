<?php

// Datos para la autenticación
$authData = array(
    "username" => "prueba.importshop.api",
    "password" => "!mp0rt@sh@23"
);

// Realiza la solicitud para obtener el token de autenticación
$ch = curl_init('https://api.laarcourier.com:9727/authenticate');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($authData));
$response = curl_exec($ch);
curl_close($ch);

// Decodifica la respuesta para obtener el token
$result = json_decode($response, true);
$token = $result['token'];
//echo 'sd'.$token;
// Datos para la siguiente solicitud con el token obtenido
$shippingData = array(
    "origen" => array(
        "identificacionO" => "1001995123",
        "ciudadO" => "201001001001",
        "nombreO" => "andres celleri",
        "direccion" => "vellanss y cipreses",
        "referencia" => "",
        "numeroCasa" => "",
        "postal" => "",
        "telefono" => "",
        "celular" => "3960000"
    ),
    "destino" => array(
        "identificacionD" => "1760411569",
        "ciudadD" => "201001001001",
        "nombreD" => "Jose",
        "direccion" => "El inca",
        "referencia" => "Frente al Aki Molineros",
        "numeroCasa" => "",
        "postal" => "",
        "telefono" => "0983722209",
        "celular" => "0983722209"
    ),
    "numeroGuia" => "impo012",
    "tipoServicio" => "201202002002013",
    "noPiezas" => 1,
    "peso" => 1.3,
    "valorDeclarado" => 15.3,
    "contiene" => "DECODIFICADOR",
    "tamanio" => "",
    "cod" => false,
    "costoflete" => 0,
    "costoproducto" => 0,
    "tipocobro" => 0,
    "comentario" => "",
    "fechaPedido" => "",
    "retorno" => array(
        "tipoServicio" => "",
        "noPiezas" => 0,
        "peso" => 0,
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

// Realiza la solicitud utilizando el token obtenido
$ch2 = curl_init('https://api.laarcourier.com:9727/guias/contado?isRetorno=false');
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $token
));
curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($shippingData));
$response2 = curl_exec($ch2);
curl_close($ch2);

// Maneja la respuesta de la segunda solicitud
var_dump($response2); // Aquí puedes manejar la respuesta según lo necesites

?>
