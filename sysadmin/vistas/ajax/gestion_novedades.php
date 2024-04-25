<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


$guia = $_POST['guia'];
$observacion = $_POST['observacion'];
$transporte = $_POST['transporte'];
if ($transporte == 'SERVIENTREGA') {

    $url = "https://servientrega-ecuador.appsiscore.com/app/ws/confirmaciones.php?wsdl";

    $xml = <<<XML
<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
xmlns:ws="https://servientrega-ecuador.appsiscore.com/app/ws">
<soapenv:Header/>
<soapenv:Body>
<ws:getXML soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
<guia xsi:type="xsd:string">$guia</guia>
<observacion xsi:type="xsd:string">$observacion</observacion>
<usugenera xsi:type="xsd:string">integracion.api.1</usugenera>
<usu xsi:type="xsd:string">IMPCOMEX</usu>
<pwd xsi:type="xsd:string">Rtcom-ex9912</pwd>
<tokn xsi:type="xsd:string">1593aaeeb60a560c156387989856db6be7edc8dc220f9feae3aea237da6a951d</tokn>
</ws:getXML>
</soapenv:Body>
</soapenv:Envelope>
XML;

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    curl_close($ch);

    echo $response;
}
