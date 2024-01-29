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

$conexion_market = mysqli_connect("localhost", "imporsuit_marketplace", "imporsuit_marketplace", "imporsuit_marketplace");

// validar si tiene enlace referido
$validar_referido = "SELECT referido FROM plataformas WHERE url_imporsuit = '$dominio_actual'";
$query_validar_referido = mysqli_query($conexion_market, $validar_referido);
$row_validar_referido = mysqli_fetch_array($query_validar_referido);
$referido = $row_validar_referido['referido'];
if ($referido == 0 || $referido == '' || $referido == NULL) {
    echo '<div class="alert alert-warning alert-dismissible" role="alert" align="center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Aviso!</strong> Aún no tienes un enlace de referido
    
    <br>
    <button class="btn btn-sm btn-success" onclick="generar_referido()">Generar enlace</button>

</div>';
    exit;
}

permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == "ajax") {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $sTable = "plataformas";
    $sWhere = "";
    $sWhere .= " WHERE tienda = '$dominio_completo'";
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
            <strong>Aviso!</strong> No hay Registro de Referidos
        </div>
<?php
    }
}

?>