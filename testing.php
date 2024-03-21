<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$wsdl = "https://servientrega-ecuador-prueba.appsiscore.com/app/ws/server_ciudades.php?wsdl";
$options = [
    'trace' => 1,
    'exceptions' => true,
    'soap_version' => SOAP_1_1, // Especificando la versión de SOAP, basado en tu WSDL
    'style' => SOAP_RPC, // Indicando el uso de RPC
    'use' => SOAP_ENCODED, // Codificación usada
];

try {
    $client = new SoapClient($wsdl, $options);

    $params = [
        new SoapParam('impor.comex', 'usu'),
        new SoapParam('123456', 'pwd'),
        new SoapParam('1593aaeeb60a560c156387989856db6be7edc8dc220f9feae3aea237da6a951d', 'tokn'),
        new SoapParam('MERCANCIA PREMIER', 'producto'),
        new SoapParam('GUAYAQUIL', 'origen'),
        new SoapParam('GUAYAQUIL', 'destino'),
        new SoapParam('200', 'valor_mercaderia'),
        new SoapParam('1', 'piezas'),
        new SoapParam('3', 'peso'),
        new SoapParam('1', 'alto'),
        new SoapParam('1', 'ancho'),
        new SoapParam('1', 'largo'),
        new SoapParam('Servvi', 'entidad'),
    ];

    // Llamada al método
    $response = $client->__soapCall('getXML', $params);
    echo "<pre>";
    print_r($response);
    echo "</pre>";
} catch (SoapFault $fault) {
    print_r($fault);
}
