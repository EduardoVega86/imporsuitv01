<?php session_start(); ?>
<head>
<style>
        .loader-page {
    position: fixed;
    z-index: 25000;
    background: rgb(255, 255, 255);
    left: 0px;
    top: 0px;
    height: 100%;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition:all .3s ease;
  }
  .loader-page::before {
    content: "";
    position: absolute;
    border: 2px solid rgb(50, 150, 176);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    box-sizing: border-box;
    border-left: 2px solid rgba(50, 150, 176,0);
    border-top: 2px solid rgba(50, 150, 176,0);
    animation: rotarload 1s linear infinite;
    transform: rotate(0deg);
  }
  @keyframes rotarload {
      0%   {transform: rotate(0deg)}
      100% {transform: rotate(360deg)}
  }
  .loader-page::after {
    content: "";
    position: absolute;
    border: 2px solid rgba(50, 150, 176,.5);
    width: 60px;
    height: 60px;
    border-radius: 50%;
    box-sizing: border-box;
    border-left: 2px solid rgba(50, 150, 176, 0);
    border-top: 2px solid rgba(50, 150, 176, 0);
    animation: rotarload 1s ease-out infinite;
    transform: rotate(0deg);
  }
    </style>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../../assets/js/lib_firma_sri/js/uft8.js"></script>
<script src="../../assets/js/lib_firma_sri/js/fiddle.js"></script>
<script src="../../assets/js/lib_firma_sri/js/forge.min.js"></script>
<script src="../../assets/js/lib_firma_sri/js/moment.min.js"></script>
<script src="../../assets/js/lib_firma_sri/js/buffer.js"></script>
<?php
/*-------------------------
Autor: Obed Alvarado
Web: obedalvarado.pw
Mail: info@obedalvarado.pw
---------------------------*/
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../../../login.php");
    exit;
}
/* Connect To Database*/
include "../../db.php";
include "../../php_conexion.php";
//Archivo de funciones PHP
include "../../funciones.php";

function validar_clave($clave) {

    if ($clave == "") {
        $verificado = false;
        return $verificado;
    }

    $x = 2;
    $sumatoria = 0;
    for ($i = strlen($clave) - 1; $i >= 0; $i--) {
        if ($x > 7) {
            $x = 2;
        }
        $sumatoria = $sumatoria + ($clave[$i] * $x);
        $x++;
    }
    $digito = $sumatoria % 11;
    $digito = 11 - $digito;

    switch ($digito) {
        case 10:
            $digito = "1";
            break;
        case 11:
            $digito = "0";
            break;
    }

    /*
      if (strtolower($digito_v)==$digito){
      $verificado=true;
      } else {
      $verificado=false;
      }

     */

    return $digito;
}

$id_credito = intval($_GET['id_factura']);

$sql_count  = mysqli_query($conexion, "select * from notacredito where id_factura='" . $id_credito . "'");
$count      = mysqli_num_rows($sql_count);
if ($count == 0) {
    echo "<script>alert('Factura no encontrada')</script>";
    echo "<script>window.close();</script>";
    exit;
}
$sql_factura    = mysqli_query($conexion, "select * from notacredito where id_factura='" . $id_credito . "'");
$rw_factura     = mysqli_fetch_array($sql_factura);


$xml_detalles = '<detalles>';
$query = mysqli_query($conexion, "SELECT  productos.id_producto, productos.codigo_producto as 'codigo', productos.descripcion_producto as 'descripcion',
                                  notacreditohasproducto.cantidad as 'cantidad', notacreditohasproducto.precio_venta as 'precioUnitario' 
                                  FROM notacreditohasproducto
      INNER JOIN notacredito  ON notacreditohasproducto.id_notacredito = notacredito.id_factura
      left JOIN productos ON productos.id_producto = notacreditohasproducto.id_producto WHERE notacreditohasproducto.id_notacredito = '" . $id_credito . "'");
$contadorProductos = 0;
$detallesProductos = array();
$totalSinImpuestos = 0;

while ($data_productos = $query->fetch_assoc()) {
    
    if($data_productos["descripcion"] == ''){
        $descripcion = 'sin descripcion';
    }else{
        $descripcion = $data_productos["descripcion"];
    }
    $xml_detalles .= '<detalle>
    <codigoInterno>01</codigoInterno>
    <descripcion>' .$descripcion . '</descripcion>
    <cantidad>' . $data_productos['cantidad'] . '</cantidad>
    <precioUnitario>' .number_format( $data_productos['precioUnitario'], 2) . '</precioUnitario>            
    <descuento>0.00</descuento>
    <precioTotalSinImpuesto>' . number_format($data_productos['precioUnitario'], 2)  . '</precioTotalSinImpuesto>';
    $xml_detalles .= '<impuestos>';
            
                  $xml_detalles .= '
              <impuesto>
                  <codigo>2</codigo>
                  <codigoPorcentaje>0</codigoPorcentaje>
                  <tarifa>0</tarifa>
                  <baseImponible>' .number_format( $data_productos['precioUnitario'], 2)  . '</baseImponible>
                  <valor>0</valor>
              </impuesto></impuestos></detalle>
          ';
    $totalSinImpuestos +=  $data_productos['precioUnitario'];
    
    //$totalSinImpuestostotal +=  $dataCitas['valortotal'];
}
$xml_detalles .= '</detalles>';

// Datos para el Encabezado del XML
$query = mysqli_query($conexion, "SELECT * from perfil ORDER BY id_perfil DESC")
or die('error: ' . mysqli_error($conexion));
$dataperfil = mysqli_fetch_assoc($query);
$id_tipo_ambiente= $dataperfil['ambiente'];
$id_tipo_emision = $dataperfil['tipoEmision'];
$razon_social_empresa = $dataperfil['giro_empresa'];
$nombre_comercial_empresa = $dataperfil['nombre_empresa'];
$nro_documento_empresa = $dataperfil['ruc'];
//$nro_documento_empresa = '1713683801001';


$clave_acceso = '';
$codigo_establecimiento = $dataperfil['codigo_establecimiento'];
$codigo_punto_emision = $dataperfil['codigo_punto_emision'];
//$secuencial = $id_factura;
$secuencial = $id_credito;   
$direccion_empresa = $dataperfil['direccion'];
//$fecha_emision = date('m/d/Y h:i:s a', time());
$fecha_emision = date('m/d/Y h:i:s a', time());

$direccion_sucursal = $dataperfil['direccion'];
//$id_tipo_documento = '05';
$id_tipo_documento = '04';

$ruta_firma = $dataperfil['firma'];
$pass_firma = $dataperfil['passFirma'];
$valortotal = $rw_factura['monto_factura'];
$fechaemisiondocmodulo = $rw_factura['fechaemisiondocmodulo'];
$fechaemisiondocmodulo = date('d/m/Y', strtotime($fechaemisiondocmodulo));
$motivo = $rw_factura['motivo'];
$numdocmod = $rw_factura['numdocmod'];

$clave = "" . date('dmY', strtotime($fecha_emision)) . "" . '04' . "" . $nro_documento_empresa . "" . $id_tipo_ambiente . "" . $codigo_establecimiento . "" . $codigo_punto_emision . "" . str_pad($secuencial, '9', '0', STR_PAD_LEFT) . "" . str_pad($id_credito, '8', '0', STR_PAD_LEFT) . "" . $id_tipo_emision . "";
$digito_verificador_clave = validar_clave($clave);
$clave_acceso = "" . date('dmY', strtotime($fecha_emision)) . "" . '04' . "" . $nro_documento_empresa . "" . $id_tipo_ambiente . "" . $codigo_establecimiento . "" . $codigo_punto_emision . "" . str_pad($secuencial, '9', '0', STR_PAD_LEFT) . "" . str_pad($id_credito, '8', '0', STR_PAD_LEFT) . "" . $id_tipo_emision  . "" . $digito_verificador_clave . "";
   
$xml = '<?xml version="1.0" encoding="UTF-8"?>
    <notaCredito id="comprobante" version="1.0.0">
        <infoTributaria>
            <ambiente>' . $id_tipo_ambiente . '</ambiente>
            <tipoEmision>' . $id_tipo_emision . '</tipoEmision>
            <razonSocial>' . $razon_social_empresa . '</razonSocial>
            <nombreComercial>' . $nombre_comercial_empresa . '</nombreComercial>
            <ruc>' . $nro_documento_empresa . '</ruc>
            <claveAcceso>' . $clave_acceso . '</claveAcceso>
            <codDoc>04</codDoc>
            <estab>' . $codigo_establecimiento . '</estab>
            <ptoEmi>' . $codigo_punto_emision . '</ptoEmi>
            <secuencial>' . str_pad($secuencial, '9', '0', STR_PAD_LEFT) . '</secuencial>
            <dirMatriz>' . $direccion_empresa . '</dirMatriz>
        </infoTributaria>
        <infoNotaCredito>
            <fechaEmision>' . date("d/m/Y", strtotime($fecha_emision)) . '</fechaEmision>
            <dirEstablecimiento>' . $direccion_sucursal . '</dirEstablecimiento>
            <tipoIdentificacionComprador>' . $id_tipo_documento . '</tipoIdentificacionComprador>
            <razonSocialComprador>Alexandra</razonSocialComprador>
            <identificacionComprador>0490041877001</identificacionComprador>
            <obligadoContabilidad>NO</obligadoContabilidad>
            <codDocModificado>01</codDocModificado>
            <numDocModificado>'.$numdocmod.'</numDocModificado>
            <fechaEmisionDocSustento>'. $fechaemisiondocmodulo . '</fechaEmisionDocSustento>';
            $xml.='<totalSinImpuestos>' . number_format($valortotal, 2) . '</totalSinImpuestos>';
            $xml .= '<valorModificacion>' . number_format($valortotal, 2) . '</valorModificacion>
            <moneda>DOLAR</moneda>';
            $xml .='<totalConImpuestos>
                <totalImpuesto>
                    <codigo>2</codigo>
                    <codigoPorcentaje>0</codigoPorcentaje>
                    <baseImponible>' . number_format($totalSinImpuestos, 2) . '</baseImponible>
                    <valor>0.00</valor>
                </totalImpuesto>';
            $xml .='</totalConImpuestos>        
            <motivo>motivo</motivo>
        </infoNotaCredito>';
        $xml_detalles .= '
        <infoAdicional>
            <campoAdicional nombre="Direccion">direccion</campoAdicional>
            <campoAdicional nombre="Telefono">telefono</campoAdicional>		
            <campoAdicional nombre="Email">email</campoAdicional>
        </infoAdicional>
    </notaCredito>';
    
    
//$file = fopen("C:/xampp/htdocs/punto_venta/vistas/xml/comprobantes/NC_" . $id_credito . ".xml", "w+");
$file = fopen("../comprobantes/NC_" . $id_credito . ".xml", "w+");
fwrite($file, $xml.$xml_detalles);

/*$ruta_factura = 'http://localhost/punto_venta/vistas/xml/comprobantes/NC_' . $id_credito . ".xml";
$ruta = 'http://localhost/punto_venta/vistas/xml/firmas/'.$ruta_firma;*/
  $currentUrl = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
// URL base local (por ejemplo, localhost)
$localBaseUrl = 'localhost'; // Puedes modificar esto según tu configuración
// Comprobar si la URL actual contiene la URL base local
if (strpos($currentUrl, $localBaseUrl) !== false) {
    $sistema_url='/imporsuitv01';
} else {
   $sistema_url='';
}

$ruta_factura = 'http://'.$_SERVER['HTTP_HOST'].$sistema_url.'/vistas/xml/comprobantes/NC_' . $id_credito . ".xml";
$ruta = 'http://'.$_SERVER['HTTP_HOST'].$sistema_url.'/vistas/xml/firmas/'.$ruta_firma;
$ruta_certificado =  $ruta;
$pass = $pass_firma;
$ruta_respuesta='';

echo ' <script>obtenerComprobanteFirmado_sri("' . $ruta_certificado . '","' . $pass . '","' .$ruta_respuesta. '","' .$ruta_factura.'","' .$id_credito.'","NOTA CREDITO")</script>';
?>
    <script>
       /*     $(window).on('load', function () {
                setTimeout(function () {
                    $(".loader-page").css({visibility:"hidden",opacity:"0"})
                }, 20000);
                
            });*/
        </script>
<?php
