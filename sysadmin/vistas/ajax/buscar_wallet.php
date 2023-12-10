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
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
if ($action == "ajax") {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $sTable = "cabecera_cuenta_cobrar, facturas_cot";
    $sWhere = "";
    $sWhere .= " WHERE cabecera_cuenta_cobrar.numero_factura=facturas_cot.numero_factura";
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
    $count_query   = mysqli_query($conexion, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $row = mysqli_fetch_array($count_query);
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload = '../reportes/wallet.php';
    //main query to fetch the data
    $sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    $query = mysqli_query($conexion, $sql);
    //loop through fetched data


    if ($numrows > 0) {
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

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr class="info">
                        <th class="text-center"># Orden </th>
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

                        <th colspan="3"></th>
                    </tr>
                </thead>
                <tbody id="resultados">

                    <?php
                    while ($row = mysqli_fetch_array($query)) {
                        $id_factura = $row['numero_factura'];
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

                        switch ($guia_enviada) {
                            case 1:
                                $guia_enviada = "Pendiente";
                                break;
                            case 2:
                                $guia_enviada = "Por recolectar";
                                break;
                            case 3:
                                $guia_enviada = "Recolectado";
                                break;
                            case 4:
                                $guia_enviada = "En bodeg";
                                break;

                            case 5:
                                $guia_enviada = "En transito";
                                break;
                            case 6:
                                $guia_enviada = "Zona de entrega";
                                break;
                            case 7:
                                $guia_enviada = "Entregado";
                                break;
                            case 8:
                                $guia_enviada = "Anulado";
                                break;
                            case 9:
                                $guia_enviada = "Devuelto";
                                break;
                            case 10:
                                $guia_enviada = "Facturado  ";
                                break;
                        }
                        $label_class = 'badge-purple';
                        $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
                    ?>
                        <input type="hidden" value="<?php echo $estado_factura; ?>" id="estado<?php echo $id_factura; ?>">

                        <tr>
                            <td class="text-center"><label class="badge badge-purple"> <?php echo $id_factura; ?></label></td>
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
                            <td class="text-center">
                                <div class="btn-group dropdown">
                                    <button type="button" class="btn btn-warning btn-sm dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <?php if ($permisos_editar == 1) { ?>
                                            <a class="dropdown-item" href="editar_wallet.php?id_factura=<?php echo $id_factura; ?>"><i class='fa fa-edit'></i> Editar</a>
                                            <!--a class="dropdown-item" href="#" onclick="imprimir_factura('<?php echo $id_factura; ?>');"><i class='fa fa-print'></i> Imprimir</a-->
                                        <?php }
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