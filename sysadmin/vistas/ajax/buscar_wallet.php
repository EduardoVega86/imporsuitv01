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
                        <th class="text-center">Estado Pedido</th>
                        <th class="text-center">Total Venta</th>
                        <th class="text-center">Costo</th>
                        <th class="text-center">Precio de Envio</th>
                        <th class="text-center">Monto a recibir</th>
                        <th></th>
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

                        if ($estado_factura == 1) {
                            $text_estado = "INGRESADA";
                            $label_class = 'badge-success';
                        } else {
                            $text_estado = "CREDITO";
                            $label_class = 'badge-danger';
                        }

                        switch ($estado_factura) {
                            case 1:
                                $text_estado = "Confirmar";
                                $label_class = 'badge-success';
                                break;
                            case 2:
                                $text_estado = "Pick y Pack ";
                                $label_class = 'badge-info';
                                break;
                            case 3:
                                $text_estado = "Despachado";
                                $label_class = 'badge-success';
                                break;
                            case 4:
                                $text_estado = "Zona de entrega ";
                                $label_class = 'badge-purple';
                                break;
                            case 5:
                                $text_estado = "Cobrado";
                                $label_class = 'badge-warning';
                                break;
                            case 6:
                                $text_estado = "Pagado ";
                                $label_class = 'badge-purple';
                                break;

                            case 7:
                                $text_estado = "Liquidado";
                                $label_class = 'badge-primary';
                                break;
                            case 8:
                                $text_estado = "Anulado";
                                $label_class = 'badge-danger';
                                break;
                            default:
                                echo "Estado no reconocido";
                        }

                        $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
                    ?>
                        <input type="hidden" value="<?php echo $estado_factura; ?>" id="estado<?php echo $id_factura; ?>">

                        <tr>
                            <td class="text-center"><label class="badge badge-purple"> <?php echo $id_factura; ?></label></td>
                            <td class="text-center"><?php echo $fecha; ?></td>
                            <td class="text-center"><?php echo $nombre_cliente; ?></td>
                            <td class="text-center"><?php echo $tienda; ?></td>

                            <td class="text-center"><span class="badge <?php echo $label_class; ?>"><?php echo $text_estado; ?></span></td>
                            <td class="text-center"><?php echo $simbolo_moneda . $total_venta; ?></td>
                            <td class="text-center"><?php echo $simbolo_moneda . $costo; ?></td>
                            <td class="text-center"><?php echo $simbolo_moneda . $precio_envio; ?></td>
                            <td class="text-center"><?php echo $simbolo_moneda . $monto_recibir; ?></td>
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