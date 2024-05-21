<?php
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";

//Obtenemos la fecha actual
$fecha = date('Y-m-d');
$fecha_desde = $_POST['fecha_desde'];

//buscamos los datos de la tabla wallet

$consulta = "SELECT * FROM guia_laar WHERE fecha BETWEEN '$fecha_desde' AND '$fecha' ORDER BY fecha DESC";
$resultado = mysqli_query($conexion, $consulta) or die(mysqli_error($conexion));
//Guardamos los datos en un array
$rows = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
//Recorremos el array y mostramos los datos

foreach ($rows as $row) {
    $data = array();
    if (strpos($row['guia_laar'], "IMP") === 0) {
        if ($row['estado_guia'] == 7) {
            $data["noGuia"] = $row['guia_laar'];
            $data["estadoActualCodigo"] = 7;
            $data["novedades"] = array(
                array(
                    "codigoTipoNovedad" => 43,
                    "nombreTipoNovedad" => "Guía entrega",
                    "codigoDetalleNovedad" => 17,
                    "nombreDetalleNovedad" => "Guía entregada al cliente",
                    "numeroMaximo" => 3,
                    "observacion" => "Guía entregada al cliente",
                    "fechaNovedad" => "2021-09-01",
                )
            );
        } else if ($row['estado_guia'] == 9) {
            $data["noGuia"] = $row['guia_laar'];
            $data["estadoActualCodigo"] = 9;
            $data["novedades"] = array(
                array(
                    "codigoTipoNovedad" => 42,
                    "nombreTipoNovedad" => "Guía devuelta",
                    "codigoDetalleNovedad" => 18,
                    "nombreDetalleNovedad" => "Guía devuelta al remitente",
                    "numeroMaximo" => 3,
                    "observacion" => "Guía devuelta al remitente",
                    "fechaNovedad" => "2021-09-01",
                ),
                array(
                    "codigoTipoNovedad" => 96,
                    "nombreTipoNovedad" => "Guía devuelta",
                    "codigoDetalleNovedad" => 18,
                    "nombreDetalleNovedad" => "Guía devuelta al remitente",
                    "numeroMaximo" => 3,
                    "observacion" => "Guía devuelta al remitente",
                    "fechaNovedad" => "2021-09-01",
                )
            );
        }
    } else if (strpos($row["guia_laar"], "FAST") === 0) {
        if ($row['estado_guia'] == 3) {
            $data["noGuia"] = $row['guia_laar'];
            $data["estadoActualCodigo"] = 7;
            $data["novedades"] = array(
                array(
                    "codigoTipoNovedad" => 43,
                    "nombreTipoNovedad" => "Guía entrega",
                    "codigoDetalleNovedad" => 17,
                    "nombreDetalleNovedad" => "Guía entregada al cliente",
                    "numeroMaximo" => 3,
                    "observacion" => "Guía entregada al cliente",
                    "fechaNovedad" => "2021-09-01",
                )
            );
        } else if ($row['estado_guia'] == 4) {
            $data["noGuia"] = $row['guia_laar'];
            $data["estadoActualCodigo"] = 9;
            $data["novedades"] = array(

                array(
                    "codigoTipoNovedad" => 42,
                    "nombreTipoNovedad" => "Guía devuelta",
                    "codigoDetalleNovedad" => 18,
                    "nombreDetalleNovedad" => "Guía devuelta al remitente",
                    "numeroMaximo" => 3,
                    "observacion" => "Guía devuelta al remitente",
                    "fechaNovedad" => "2021-09-01",
                ),
                array(
                    "codigoTipoNovedad" => 96,
                    "nombreTipoNovedad" => "Guía devuelta",
                    "codigoDetalleNovedad" => 18,
                    "nombreDetalleNovedad" => "Guía devuelta al remitente",
                    "numeroMaximo" => 3,
                    "observacion" => "Guía devuelta al remitente",
                    "fechaNovedad" => "2021-09-01",
                )
            );
        }
    } else if (is_numeric($row["guia_laar"])) {
        if ($row['estado_guia'] >= 500 && $row["estado_guia"] <= 504) {
            $data["noGuia"] = $row['guia_laar'];
            $data["novedades"] = array(
                array(
                    "codigoTipoNovedad" => 43,
                    "nombreTipoNovedad" => "Guía entrega",
                    "codigoDetalleNovedad" => 17,
                    "nombreDetalleNovedad" => "Guía entregada al cliente",
                    "numeroMaximo" => 3,
                    "observacion" => "Guía entregada al cliente",
                    "fechaNovedad" => "2021-09-01",
                )
            );
        } else if ($row['estado_guia'] == 9) {
            $data["noGuia"] = $row['guia_laar'];
            $data["novedades"] = array(
                array(
                    "codigoTipoNovedad" => 42,
                    "nombreTipoNovedad" => "Guía devuelta",
                    "codigoDetalleNovedad" => 18,
                    "nombreDetalleNovedad" => "Guía devuelta al remitente",
                    "numeroMaximo" => 3,
                    "observacion" => "Guía devuelta al remitente",
                    "fechaNovedad" => "2021-09-01",
                ),
                array(
                    "codigoTipoNovedad" => 96,
                    "nombreTipoNovedad" => "Guía devuelta",
                    "codigoDetalleNovedad" => 18,
                    "nombreDetalleNovedad" => "Guía devuelta al remitente",
                    "numeroMaximo" => 3,
                    "observacion" => "Guía devuelta al remitente",
                    "fechaNovedad" => "2021-09-01",
                )
            );
        }
    }
}
