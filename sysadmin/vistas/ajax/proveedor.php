<?php

$tienda = $_POST['tienda'];

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "imporsuit_marketplace", "imporsuit_marketplace", "imporsuit_marketplace");
$sql = "SELECT * FROM cabecera_cuenta_pagar WHERE proveedor = '$tienda' and estado_guia = 7 ORDER BY `cabecera_cuenta_pagar`.`fecha` DESC";
$result = mysqli_query($conexion, $sql);

$dato = "<hr/>";
$dato .= "<h4 class='text-center'> Pagos como proveedor </h4>";
$dato .= "<table class='table table-striped table-bordered table-hover'>";
$dato .= "<thead>";
$dato .= "<tr>";
$dato .= "<th class='text-center'># ORDEN</th>";
$dato .= "<th class='text-center'>FECHA</th>";
$dato .= "<th class='text-center'>GUIA</th>";
$dato .= "<th class='text-center'>TRANSPORTADORA</th>";
$dato .= "<th class='text-center'>VALOR DEL PRODUCTO</th>";
$dato .= "<th class='text-center'>TIENDA</th>";
$dato .= "</tr>";
$dato .= "</thead>";
$dato .= "<tbody>";

while ($mostrar = mysqli_fetch_array($result)) {
    $dato .= "<tr>";
    $dato .= "<td class='bg-purple text-center text-white'>" . $mostrar['numero_factura'] . "</td>";
    $dato .= "<td class='text-center'>" . $mostrar['fecha'] . "</td>";
    $dato .= "<td class='text-white text-center' style='background-color: #171931'>" . $mostrar['guia_laar'] . "</td>";

    // Aquí es donde decides qué transportadora mostrar
    if (strpos($mostrar['guia_laar'], "IMP") === 0) {
        $transportadora = "LAAR";
        $background = "bg-warning";
    } else if (strpos($mostrar['guia_laar'], "FAST") === 0) {
        $transportadora = "FAST";
        $background = "bg-danger";
    } else if (is_numeric($mostrar['guia_laar'])) {
        $transportadora = "SERVIENTREGA";
        $background = "bg-success";
    } else {
        $transportadora = "Desconocida"; // En caso de que no cumpla ninguna condición
    }
    $dato .= "<td class='$background text-center text-white'>" . $transportadora . "</td>"; // Mostrar transportadora

    $dato .= "<td class='text-center'>" . $mostrar['costo'] . "</td>";
    $dato .= "<td class='text-center'>" . $mostrar['tienda'] . "</td>";
    $dato .= "</tr>";
}

$dato .= "</tbody>";
$dato .= "</table>";

echo $dato;
