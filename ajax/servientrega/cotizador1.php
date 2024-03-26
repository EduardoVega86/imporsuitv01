<?php
$wsdl = "https://servientrega-ecuador-prueba.appsiscore.com/app/ws/cotizador_ser_recaudo.php?wsdl";

// Construye el cuerpo del mensaje SOAP manualmente
$soapRequest = <<<XML
<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xmlns:xsd="http://www.w3.org/2001/XMLSchema"
xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" 
    xmlns:ws="https://servientrega-ecuador.appsiscore.com/app/ws/">
<soapenv:Header/>
<soapenv:Body>
<ws:Consultar soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
<entidad xsi:type="xsd:string">PRUEBAS RECAUDOS</entidad>
<producto xsi:type="xsd:string">MERCANCIA PREMIER</producto>
<origen xsi:type="xsd:string">GUAYAQUIL</origen>
<destino xsi:type="xsd:string">QUITO-PICHINCHA</destino>
<valor_mercaderia xsi:type="xsd:string">200</valor_mercaderia>
<piezas xsi:type="xsd:string">1</piezas>
<peso xsi:type="xsd:string">3</peso>
<alto xsi:type="xsd:string">1</alto>
<ancho xsi:type="xsd:string">1</ancho>
<largo xsi:type="xsd:string">1</largo>
<tokn xsi:type="xsd:string">1593aaeeb60a560c156387989856db6be7edc8dc220f9feae3aea237da6a951d</tokn>
<usu xsi:type="xsd:string">PRUEBA</usu>
<pwd xsi:type="sd:pwd">s12345ABCDe</pwd>
</ws:Consultar>
</soapenv:Body>
</soapenv:Envelope>
XML;

$headers = [
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: text/xml",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "SOAPAction: \"run\"",  // Asegúrate de ajustar esto según lo que requiera el servicio
    "Content-length: " . strlen($soapRequest),
];

$ch = curl_init();
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_URL, $wsdl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $soapRequest); // La petición SOAP
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_VERBOSE, true);
// Configura opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Ignora la verificación de SSL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$verbose = fopen('php://temp', 'w+');
curl_setopt($ch, CURLOPT_STDERR, $verbose);

// Envía la solicitud
$response = curl_exec($ch);

// Comprueba si ocurrió un error
if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    echo "cURL Error: $error_msg";
} else {
    echo "Respuesta: \n$response";
}

curl_close($ch);