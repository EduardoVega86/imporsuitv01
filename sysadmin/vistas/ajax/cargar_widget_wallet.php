<?php
include "is_logged.php"; //Acrhivo comprueba si el usuario esta logueado

$tienda = $_GET['tienda'];

echo $tienda;
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
#require_once "../libraries/inventory.php"; //Contiene funcion que controla stock en el inventario
//Inicia Control de Permisos
include "../permisos.php";
//Archivo de funciones PHP
require_once "../funciones.php";
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
$valor_total_tienda_sql = "SELECT SUM(subquery.total_venta) as total_ventas, SUM(subquery.total_pendiente) as total_pendiente FROM ( SELECT numero_factura, MAX(total_venta) as total_venta, MAX(valor_pendiente) as total_pendiente FROM cabecera_cuenta_pagar WHERE tienda = '$tienda' GROUP BY numero_factura ) as subquery;";
$valor_total_tienda_query = mysqli_query($conexion, $valor_total_tienda_sql);
$valor_total_tienda = mysqli_fetch_array($valor_total_tienda_query);
$valor_total_tienda = $valor_total_tienda['total_ventas'];
$valor_total_pendiente = $valor_total_tienda['total_pendiente'];
echo $valor_total_tienda;
$valor_total_tienda = (float)$valor_total_tienda;

?>
<div class="col-lg-12 col-md-6">
    <div class="card-box widget-icon">
        <div>
            <i class="mdi mdi-briefcase-check text-primary"></i>
            <div class="wid-icon-info text-right">
                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">MONTO DE VENTA</p>
                <h4 class="m-t-0 m-b-5 counter font-bold text-primary"><?php echo $simbolo_moneda . '' . number_format($valor_total_tienda, 2); ?></h4>
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
                <h4 class="m-t-0 m-b-5 counter font-bold text-danger"><?php echo $simbolo_moneda . '' . number_format($valor_total_pendiente, 2); ?></h4>
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
                <h4 class="m-t-0 m-b-5 counter font-bold text-danger"><?php echo $simbolo_moneda . '' . number_format($valor_total_pendiente, 2); ?></h4>
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