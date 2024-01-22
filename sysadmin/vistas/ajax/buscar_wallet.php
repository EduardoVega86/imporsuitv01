<?php
/*-------------------------
Autor: Eduardo Vega
---------------------------*/


include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Wallets";
// dominio mas protocolo
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

$dominio_completo =     $protocol . $_SERVER['HTTP_HOST'];

$dominio_actual = $_SERVER['HTTP_HOST'];

$dominio_actual = str_replace('www.', '', $dominio_actual);
$dominio_actual = str_replace('.com', '', $dominio_actual);
$dominio_actual = str_replace('.net', '', $dominio_actual);

permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($dominio_actual == 'marketplace.imporsuit') {

    if ($action == "ajax") {
        // escaping, additionally removing everything that could be (html/javascript-) code
        $q = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $sTable = "cabecera_cuenta_pagar, facturas_cot";
        $sWhere = "";
        $sWhere .= " WHERE cabecera_cuenta_pagar.numero_factura=facturas_cot.numero_factura";
        if ($_GET['q'] != "") {
            $sWhere .= " and cabecera_cuenta_pagar.tienda like '%$q%'";
        }
        $sWhere .= "";


        include 'pagination.php'; //include pagination file
        //pagination variables  
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($conexion, "SELECT count(DISTINCT cabecera_cuenta_pagar.tienda) AS numrows FROM $sTable  $sWhere");
        $row = mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows / $per_page);
        $reload = '../reportes/wallet.php';
        //main query to fetch the data
        $sql = "SELECT DISTINCT cabecera_cuenta_pagar.tienda FROM  $sTable $sWhere order by cabecera_cuenta_pagar.tienda asc LIMIT $offset,$per_page ";
        $query = mysqli_query($conexion, $sql);
        $query = mysqli_fetch_all($query);

        if ($numrows > 0 && $dominio_actual == 'marketplace.imporsuit') {
?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr class="info">
                            <th class="text-center">Tienda </th>
                            <th class="text-center">Total Venta</th>
                            <th class="text-center">Total Utilidad</th>
                            <th class="text-center">Guías Pendientes</th>
                            <th colspan="3"></th>
                        </tr>
                    </thead>
                    <tbody id="resultados">

                        <?php
                        foreach ($query as $row) {
                            $tienda = $row[0];

                            $total_venta_sql = "SELECT SUM(subquery.total_venta) as total_ventas, SUM(subquery.total_pendiente) as total_pendiente FROM ( SELECT numero_factura, MAX(total_venta) as total_venta, MAX(valor_pendiente) as total_pendiente FROM cabecera_cuenta_pagar WHERE tienda = '$tienda' and visto = '1' GROUP BY numero_factura ) as subquery;";

                            $query_total_venta = mysqli_query($conexion, $total_venta_sql);
                            $row_total_venta = mysqli_fetch_array($query_total_venta);


                            $total_venta = $row_total_venta['total_ventas'];
                            $total_pendiente = $row_total_venta['total_pendiente'];

                            $total_venta = number_format($total_venta, 2);
                            $total_pendiente = number_format($total_pendiente, 2);

                            $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);

                            $guias_faltantes = "SELECT COUNT(*) FROM cabecera_cuenta_pagar WHERE tienda = '$tienda' AND (visto = 0 OR visto IS NULL)";
                            $query_guias_faltantes = mysqli_query($conexion, $guias_faltantes);
                            $row_guias_faltantes = mysqli_fetch_array($query_guias_faltantes);
                            $guias_faltantes = $row_guias_faltantes[0];


                        ?>

                            <tr>
                                <td class="text-center"><?php echo $tienda; ?></td>
                                <td class="text-center"><?php echo $simbolo_moneda . $total_venta; ?></td>
                                <td class="text-center"><?php echo $simbolo_moneda . $total_pendiente; ?></td>
                                <td class="text-center"><?php echo $guias_faltantes; ?></td>
                                <td class="text-center">
                                    <div class="btn-group dropdown">
                                        <button type="button" class="btn btn-warning btn-sm dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            <?php
                                            if ($permisos_eliminar == 1) { ?>
                                                <!--<a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $row['id_factura']; ?>"><i class='fa fa-trash'></i> Eliminar</a>-->
                                            <?php } ?>
                                            <a href="pagar_wallet.php?id_factura=<?php echo $id_factura ?>&tienda=<?php echo $tienda ?>" class="dropdown-item"> <i class="ti-wallet"></i> Pagar </a>

                                        </div>

                                    </div>

                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                    <tr>
                        <td colspan=10><span class="pull-right">
                                <?php
                                echo paginate($reload, $page, $total_pages, $adjacents);
                                ?></span></td>
                    </tr>

                </table>
            </div>
        <?php
        } else {
        ?>
            <div class="alert alert-warning alert-dismissible" role="alert" align="center">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> No hay Registro de Cotizaciones
            </div>
            <?php
        }
    }
} else {
    if ($action == "ajax") {
        // escaping, additionally removing everything that could be (html/javascript-) code
        $sDominio = 'imporsuit_marketplace';
        $conexion_db = mysqli_connect('localhost', $sDominio, $sDominio, $sDominio);
        $q = mysqli_real_escape_string($conexion_db, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
        $sTable = "cabecera_cuenta_pagar, facturas_cot";
        $sWhere = "";
        $sWhere .= " WHERE  cabecera_cuenta_pagar.tienda = '$dominio_completo' and cabecera_cuenta_pagar.numero_factura=facturas_cot.numero_factura and visto ='1' ";
        if ($_GET['q'] != "") {
            $sWhere .= "";
        }
        $sWhere .= "";
        include 'pagination.php'; //include pagination file
        //pagination variables  
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($conexion_db, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row = mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows / $per_page);
        $reload = '../reportes/wallet.php';
        //main query to fetch the data
        $sql = "SELECT DISTINCT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($conexion_db, $sql);
        $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
        //loop through fetched data

        $total_pendiente_a_la_tienda_sql = "SELECT SUM(subquery.total_venta) as total_ventas, SUM(subquery.total_pendiente) as total_pendiente, SUM(subquery.total_cobrado) as total_cobrado, SUM(subquery.monto_recibir) as monto_recibir FROM ( SELECT numero_factura, MAX(total_venta) as total_venta, MAX(valor_pendiente) as total_pendiente, MAX(valor_cobrado) as total_cobrado, MAX(monto_recibir) as monto_recibir FROM cabecera_cuenta_pagar WHERE tienda = '$dominio_completo' AND visto = '1' GROUP BY numero_factura ) as subquery;";
        $query_total_pendiente_a_la_tienda = mysqli_query($conexion_db, $total_pendiente_a_la_tienda_sql);
        $row_total_pendiente_a_la_tienda = mysqli_fetch_array($query_total_pendiente_a_la_tienda);

        $valor_total_tienda = $row_total_pendiente_a_la_tienda['total_ventas'];
        $total_valor_cobrado = $row_total_pendiente_a_la_tienda['total_cobrado'];
        $total_valor_pendiente = $row_total_pendiente_a_la_tienda['total_pendiente'];
        $total_monto_recibir = $row_total_pendiente_a_la_tienda['monto_recibir'];

        $guias_faltantes = "SELECT COUNT(*) FROM cabecera_cuenta_pagar WHERE tienda = '$dominio_completo' AND (visto = 0 OR visto IS NULL)";
        $query_guias_faltantes = mysqli_query($conexion_db, $guias_faltantes);
        $row_guias_faltantes = mysqli_fetch_array($query_guias_faltantes);
        $guias_faltantes = $row_guias_faltantes[0];

        if ($numrows > 0) { {
            ?>
                <form id="filter-form">
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="fecha" id="fecha">
                    <label for="estado">Estado de Pedido:</label>
                    <select name="estado" id="estado">
                        <option value="0">Todos</option>
                        <option value="1">Confirmar</option>
                        <option value="2">Pick y Pack</option>
                        <!-- Agrega más opciones según tus estados de pedido -->
                    </select>
                    <button class="btn btn-outline-primary" type="button" onclick="filterData()">Filtrar</button>
                </form>
                <div class="col-lg-12 col-md-6">
                    <div class="card-box widget-icon">
                        <div>
                            <i class="mdi mdi-basket text-primary"></i>
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
                            <i class="mdi mdi-briefcase-check text-primary"></i>
                            <div class="wid-icon-info text-right">
                                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">Utilidad Generada</p>
                                <h4 class="m-t-0 m-b-5 counter font-bold text-primary"><?php echo $simbolo_moneda . '' . number_format($total_monto_recibir, 2); ?></h4>
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
                                <h4 class="m-t-0 m-b-5 counter font-bold text-success"><?php echo $simbolo_moneda . '' . number_format($total_valor_cobrado, 2); ?></h4>
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
                                <h4 class="m-t-0 m-b-5 counter font-bold text-danger"><?php echo $simbolo_moneda . '' . number_format($total_valor_pendiente, 2); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6">
                    <div class="card-box widget-icon">
                        <div>
                            <i class="mdi mdi-store text-danger "></i>
                            <div class="wid-icon-info text-right">
                                <p class="text-muted m-b-5 font-13 font-bold text-uppercase">Guías pendiente de revision</p>
                                <h4 class="m-t-0 m-b-5 counter font-bold text-danger"><?php echo $guias_faltantes ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr class="info">
                                <th class="text-center"># Orden </th>
                                <th class="text-center"># Guia </th>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Tienda</th>
                                <th class="text-center">Estado de la Guia</th>
                                <th class="text-center">Total Venta</th>
                                <th class="text-center">Costo</th>
                                <th class="text-center">Precio de Envio</th>
                                <th class="text-center">Monto a recibir</th>
                                <th class="text-center">Valor cobrado</th>
                                <th class="text-center">Valor pendiente</th>
                                <th class="text-center">Recibos</th>
                            </tr>
                        </thead>
                        <tbody id="resultados">
                            <?php
                            while ($row = mysqli_fetch_array($query)) {
                                $id_factura = $row['numero_factura'];
                                $id_cabecera = $row['id_cabecera'];
                                $fecha = date('d/m/Y', strtotime($row['fecha']));
                                $nombre_cliente = $row['cliente'];
                                $tienda = $row[4];
                                $estado_guia = $row['estado_guia'];
                                $total_venta = $row['total_venta'];
                                $costo = $row['costo'];
                                $precio_envio = $row['precio_envio'];
                                $monto_recibir = $row['monto_recibir'];
                                $estado_factura = $row['estado_pedido'];
                                $guia_enviada   = $row['guia_enviada'];
                                $valor_cobrado = $row['valor_cobrado'];
                                $valor_pendiente = $row['valor_pendiente'];
                                $id_factura_origen = $row['id_factura_origen'];
                                $guia_laar = "select guia_laar from guia_laar where tienda_venta ='$dominio_completo' AND id_pedido = '$id_factura_origen'";
                                $query_guia_laar = mysqli_query($conexion_db, $guia_laar);
                                $row_guia_laar = mysqli_fetch_array($query_guia_laar);
                                $guia_laar = $row_guia_laar['guia_laar'];
                                switch ($estado_guia) {
                                    case 1:
                                        $guia_enviada = "Pendiente";
                                        $label_class = 'badge-purple';
                                        break;
                                    case 2:
                                        $guia_enviada = "Por recolectar";
                                        $label_class = 'badge-info';
                                        break;
                                    case 3:
                                        $guia_enviada = "Recolectado";
                                        $label_class = 'badge-success';
                                        break;
                                    case 4:
                                        $guia_enviada = "En bodega";
                                        $label_class = 'badge-warning';
                                        break;
                                    case 5:
                                        $guia_enviada = "En transito";
                                        $label_class = 'badge-primary';
                                        break;
                                    case 6:
                                        $guia_enviada = "Zona de entrega";
                                        $label_class = 'badge-dark';
                                        break;
                                    case 7:
                                        $guia_enviada = "Entregado";
                                        $label_class = 'badge-success';
                                        break;
                                    case 8:
                                        $guia_enviada = "Anulado";
                                        $label_class = 'badge-danger';
                                        break;
                                    case 9:
                                        $guia_enviada = "Devuelto";
                                        $label_class = 'badge-danger';
                                        break;
                                    case 10:
                                        $guia_enviada = "Facturado  ";
                                        $label_class = 'badge-success';
                                        break;
                                }
                                $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
                                if ($valor_pendiente == 0) {
                                    $color_row = "table-success";
                                } elseif ($valor_pendiente < 0) {
                                    $color_row = "table-danger";
                                } else {
                                    $color_row = "table-warning";
                                }
                                $url_laar = "https://fenix.laarcourier.com/Tracking/Guiacompleta.aspx?guia=" . $guia_laar;
                                $drogshipin_sql = "SELECT * FROM facturas_cot WHERE numero_factura = '$id_factura'";
                                $query_drogshipin = mysqli_query($conexion_db, $drogshipin_sql);
                                $row_drogshipin = mysqli_fetch_array($query_drogshipin);
                                $drogshipin = $row_drogshipin['drogshipin'];
                            ?>
                                <input type="hidden" value="<?php echo $estado_factura; ?>" id="estado<?php echo $id_factura; ?>">

                                <tr class="<?php echo $color_row ?>">
                                    <td class="text-center"><label class="badge badge-purple"> <?php echo $id_factura; ?></label></td>
                                    <td class="text-center"><a href="<?php echo $url_laar; ?>" class="badge badge-pink"> <?php echo $guia_laar; ?> </a> <br> <?php
                                                                                                                                                                $numero_factura = $row['numero_factura'];

                                                                                                                                                                if ($drogshipin == 0 || $drogshipin == 4) {
                                                                                                                                                                    echo '<span class="badge badge-purple">LOCAL</span>';
                                                                                                                                                                } else {
                                                                                                                                                                    echo ' <span class="badge badge-purple">DROPSHIPIN</span>';
                                                                                                                                                                } ?> </td>
                                    <td class="text-center"><?php echo $fecha; ?></td>
                                    <td class="text-center"><?php echo $nombre_cliente; ?></td>
                                    <td class="text-center"><?php echo $tienda; ?></td>
                                    <td class="text-center"><span class="badge <?php echo $label_class; ?>"><?php echo $guia_enviada; ?></span></td>
                                    <td class="text-center"><?php echo $simbolo_moneda . $total_venta; ?></td>
                                    <td class="text-center"><?php echo $simbolo_moneda . $costo; ?></td>
                                    <td class="text-center"><?php echo $simbolo_moneda . $precio_envio; ?></td>
                                    <td class="text-center"><?php echo $simbolo_moneda . $monto_recibir; ?></td>
                                    <td class="text-center"><?php echo $simbolo_moneda . $valor_cobrado; ?></td>
                                    <td class="text-center"><?php echo $simbolo_moneda . $valor_pendiente; ?></td>
                                    <td class="text-center"><button class="btn btn-sm btn-outline-primary" onclick="cargar_recibos('<?php echo $id_cabecera ?>')"><i class="ti-receipt"></i></button></td>

                                </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                        <tr>
                            <td colspan=10><span class="pull-right">
                                    <?php
                                    echo paginate($reload, $page, $total_pages, $adjacents);
                                    ?></span></td>
                        </tr>
                    </table>
                </div>
            <?php
            }
        } else {
            ?>
            <div class="alert alert-warning alert-dismissible" role="alert" align="center">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>Aviso!</strong> No hay Registro de Guias
            </div>
<?php
        }
    }
}
?>

<script>
    function filterData() {
        var fecha = document.getElementById('fecha').value;
        var estado = document.getElementById('estado').value;

        var url = '../ajax/filtro_input.php?fecha_inicio=' + fecha + '&fecha_fin=' + fecha + '&estado=' + estado;
        var ajax = new XMLHttpRequest();
        ajax.open('GET', url, true);
        ajax.onreadystatechange = function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                document.getElementById('resultados').innerHTML = ajax.responseText;
            }
        }
        ajax.send();
    }
</script>