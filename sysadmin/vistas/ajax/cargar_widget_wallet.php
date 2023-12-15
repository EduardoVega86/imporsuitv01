<?php
include "is_logged.php"; //Archivo comprueba si el usuario esta logueado
$numero_factura = $_SESSION['numero_factura'];

/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
#require_once "../libraries/inventory.php"; //Contiene funcion que controla stock en el inventario
//Inicia Control de Permisos
include "../permisos.php";
//Archivo de funciones PHP
require_once "../funciones.php";
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
$orderSql       = "SELECT * FROM cabecera_cuenta_pagar where numero_factura = '$numero_factura'";
$orderQuery     = $conexion->query($orderSql);
$results       = $orderQuery->fetch_assoc();

$total_a_pagar = $results['total_venta'];
$valor_cobrado = $results['valor_cobrado'];
$valor_pendiente = $results['valor_pendiente'];
$tienda = $results['tienda'];

$total_pendiente_a_la_tienda_sql = "SELECT SUM(valor_pendiente) AS total_pendiente_a_la_tienda FROM cabecera_cuenta_pagar WHERE tienda = '$tienda'";

$total_pendiente_a_la_tienda_query = $conexion->query($total_pendiente_a_la_tienda_sql);
$total_pendiente_a_la_tienda_results = $total_pendiente_a_la_tienda_query->fetch_assoc();
$total_pendiente_a_la_tienda = $total_pendiente_a_la_tienda_results['total_pendiente_a_la_tienda'];

?>
<div class="col-lg-12 col-md-6">
    <div class="card-box widget-icon">
        <div>
            <i class="mdi mdi-briefcase-check text-primary"></i>
            <div class="wid-icon-info text-right">
                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">MONTO DE VENTA</p>
                <h4 class="m-t-0 m-b-5 counter font-bold text-primary"><?php echo $simbolo_moneda . '' . number_format($total_a_pagar, 2); ?></h4>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-6">
    <div class="card-box widget-icon">
        <div>
            <i class="mdi mdi-cash-multiple text-success"></i>
            <div class="wid-icon-info text-right">
                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">TOTAL ABONADO</p>
                <h4 class="m-t-0 m-b-5 counter font-bold text-success"><?php echo $simbolo_moneda . '' . number_format($valor_cobrado, 2); ?></h4>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-6">
    <div class="card-box widget-icon">
        <div>
            <i class="mdi mdi-calendar text-pink"></i>
            <div class="wid-icon-info text-right">
                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">SALDO PENDIENTE</p>
                <h4 class="m-t-0 m-b-5 counter font-bold text-danger"><?php echo $simbolo_moneda . '' . number_format($valor_pendiente, 2); ?></h4>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-6">
    <div class="card-box widget-icon">
        <div>
            <i class="mdi mdi-store text-danger "></i>
            <div class="wid-icon-info text-right">
                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">SALDO PENDIENTE A TIENDA</p>
                <h4 class="m-t-0 m-b-5 counter font-bold text-danger"><?php echo $simbolo_moneda . '' . number_format($total_pendiente_a_la_tienda, 2); ?></h4>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-6">
    <div class="card-box widget-icon">
        <div>
            <i class="mdi mdi-link text-danger "></i>

            <div class="wid-icon-info text-right">
                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">Tienda</p>

                <h4 class="m-t-0 m-b-5 counter font-bold text-success"><a href="<?php echo $tienda ?>" target="_blank"><?php echo $tienda ?></a> </h4>

            </div>
        </div>
    </div>
</div>