<?php
// URL del WSDL
$wsdl = "https://servientrega-ecuador-prueba.appsiscore.com:443/app/ws/cotizador_ser_recaudo.php?wsdl";

// Opciones del cliente SOAP, si necesitas autenticación u otras configuraciones especiales
$options = [
    'producto' => 'PRUEBAS',
    'origen' => 'GUAYAQUIL',
    'destino' => 'QUITO-PICHINCHA',
    'valor_mercaderia' => '100',
    'piezas' => '1',
    'peso' => '1',
    'alto' => '1',
    'ancho' => '1',
    'largo' => '1',
    'tokn' => '1593aaeeb60a560c156387989856db6be7edc8dc220f9feae3aea237da6a951d',
    'usu' => 'PRUEBA',
    'pwd' => 's12345ABCDe'
];

try {
    // Crear el cliente SOAP
    $client = new SoapClient($wsdl, $options);

    // Datos para enviar al método SOAP, ajusta estos según el servicio que estás consumiendo
    $parametros = [
        'producto' => 'PRUEBAS',
        'origen' => 'GUAYAQUIL',
        'destino' => 'QUITO-PICHINCHA',
        'valor_mercaderia' => '100',
        'piezas' => '1',
        'peso' => '1',
        'alto' => '1',
        'ancho' => '1',
        'largo' => '1',
        'tokn' => '1593aaeeb60a560c156387989856db6be7edc8dc220f9feae3aea237da6a951d',
        'usu' => 'PRUEBA',
        'pwd' => 's12345ABCDe'

    ];

    // Reemplaza 'nombreMetodoSoap' con el nombre real del método que deseas invocar
    $respuesta = $client->__soapCall("Consultar", $parametros);

    // Procesar la respuesta
    print_r($respuesta);
} catch (SoapFault $e) {
    // Manejo de errores
    echo "Error SOAP: " . print_r($e, true);
}
