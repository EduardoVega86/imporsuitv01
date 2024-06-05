<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include "is_logged.php"; //Acrhivo comprueba si el usuario esta logueado

$tienda = $_SESSION['tienda'];

/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
#require_once "../libraries/inventory.php"; //Contiene funcion que controla stock en el inventario
//Inicia Control de Permisos
include "../permisos.php";
//Archivo de funciones PHP
require_once "../funciones.php";
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
$valor_total_tienda_sql = "SELECT SUM(subquery.total_venta) as total_ventas, SUM(subquery.total_pendiente) as total_pendiente, SUM(subquery.total_cobrado) as total_cobrado, SUM(subquery.monto_recibir) as monto_recibir FROM ( SELECT numero_factura, MAX(total_venta) as total_venta, MAX(valor_pendiente) as total_pendiente, MAX(valor_cobrado) as total_cobrado, MAX(monto_recibir) as monto_recibir FROM cabecera_cuenta_pagar WHERE tienda = '$tienda' AND visto = '1' GROUP BY numero_factura ) as subquery;";
$valor_total_tienda_query = mysqli_query($conexion, $valor_total_tienda_sql);

$valor_total_tienda_SQL = mysqli_fetch_array($valor_total_tienda_query);

$valor_total_tienda = $valor_total_tienda_SQL['total_ventas'];
$valor_total_pendiente = $valor_total_tienda_SQL['total_pendiente'];
$valor_total_cobrado = $valor_total_tienda_SQL['total_cobrado'];
$valor_total_monto_recibir = $valor_total_tienda_SQL['monto_recibir'];

?>
<div class="col-lg-12 col-md-6">
    <div class="card-box widget-icon">
        <div>
            <i class="mdi mdi-basket-check-outline text-primary"></i>
            <div class="wid-icon-info text-right">
                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">MONTO DE VENTA</p>
                <h4 class="m-t-0 m-b-5 counter font-bold text-primary"><?php echo $simbolo_moneda . '' . number_format($valor_total_tienda, 2); ?></h4>
            </div>
        </div>
    </div>
</div>

<?php
$url_ubicacion = $_SERVER["HTTP_HOST"];
$sql_deuda = "SELECT SUM(precio_envio) FROM `cabecera_cuenta_pagar` WHERE tienda = '$tienda' AND `precio_envio`  > 0 AND visto = '1' and estado_guia = 9 ORDER by precio_envio ASC;";
$valor_total_pendiente_query = mysqli_query($conexion, $sql_deuda);
$valor_total_pendiente_SQL = mysqli_fetch_array($valor_total_pendiente_query);
$valor_total_pendiente_deuda = $valor_total_pendiente_SQL['SUM(precio_envio)'];

$sql_full = "SELECT SUM(full) FROM `cabecera_cuenta_pagar` WHERE tienda = '$tienda' AND `full` > 0 AND visto = '1' ORDER by full ASC;";
$valor_total_full_query = mysqli_query($conexion, $sql_full);
$valor_total_full_SQL = mysqli_fetch_array($valor_total_full_query);
$valor_total_full = $valor_total_full_SQL['SUM(full)'];


$sql_Ganancia = "SELECT SUM(monto_recibir) FROM `cabecera_cuenta_pagar` WHERE tienda = '$tienda' AND `monto_recibir` > 0 AND visto = '1' ORDER by monto_recibir ASC;";
$valor_total_Ganancia_query = mysqli_query($conexion, $sql_Ganancia);
$valor_total_Ganancia_SQL = mysqli_fetch_array($valor_total_Ganancia_query);
$valor_total_Ganancia = $valor_total_Ganancia_SQL['SUM(monto_recibir)'];

$sql_total_pagos = "SELECT SUM(valor) from pagos where tienda = '$tienda' and valor >0 and recarga = 0";
$valor_total_pagos_query = mysqli_query($conexion, $sql_total_pagos);
$valor_total_pagos_SQL = mysqli_fetch_array($valor_total_pagos_query);
$valor_total_pagos = $valor_total_pagos_SQL['SUM(valor)'];


?>

<div class="col-lg-12 col-md-6">
    <div class="card-box widget-icon">
        <div>
            <i class="mdi mdi-cash-100 text-success "></i>
            <div class="wid-icon-info text-right">
                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">Ganacia de Ventas</p>
                <h4 class="m-t-0 m-b-5 counter font-bold text-success"><?php echo $simbolo_moneda . '' . number_format($valor_total_Ganancia, 2); ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12 col-md-6">
    <div class="card-box widget-icon">
        <div>
            <i class="mdi mdi-exclamation text-danger "></i>
            <div class="wid-icon-info text-right">
                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">Descuento devoluciones</p>
                <h4 class="m-t-0 m-b-5 counter font-bold text-danger"><?php echo $simbolo_moneda . '' . number_format($valor_total_pendiente_deuda, 2); ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12 col-md-6">
    <div class="card-box widget-icon">
        <div>
            <i class="mdi mdi-exclamation text-danger "></i>
            <div class="wid-icon-info text-right">
                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">Descuento Full fillment</p>
                <h4 class="m-t-0 m-b-5 counter font-bold text-danger"><?php echo $simbolo_moneda . '' . number_format($valor_total_full, 2); ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12 col-md-6">
    <div class="card-box widget-icon">
        <div>
            <i class="mdi mdi-briefcase-check text-primary"></i>
            <div class="wid-icon-info text-right">
                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">Utilidad Generada</p>
                <h4 class="m-t-0 m-b-5 counter font-bold text-primary"><?php echo $simbolo_moneda . '' . number_format($valor_total_monto_recibir, 2); ?></h4>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12 col-md-6">
    <div class="card-box widget-icon">
        <div>
            <i class="mdi mdi-cash-multiple text-success"></i>
            <div class="wid-icon-info text-right">
                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">TOTAL RETIROS</p>
                <h4 class="m-t-0 m-b-5 counter font-bold text-success"><?php echo $simbolo_moneda . '' . number_format($valor_total_pagos, 2); ?></h4>
            </div>
        </div>
    </div>
</div>


<?php
$billetera_sql = "SELECT * FROM billeteras WHERE tienda = '$tienda'";
$billetera_query = mysqli_query($conexion, $billetera_sql);
$billetera = mysqli_fetch_array($billetera_query);
$valor_billetera = $billetera['saldo'];

?>

<div class="col-lg-12 col-md-6">
    <div class="card-box widget-icon">
        <div>
            <i class="mdi mdi-store text-warning "></i>
            <div class="wid-icon-info text-right">
                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">SALDO EN WALLET</p>
                <h4 class="m-t-0 m-b-5 counter font-bold text-warning"><?php echo $simbolo_moneda . '' . number_format($valor_billetera, 2); ?></h4>
            </div>
        </div>
    </div>
</div>

<?php
