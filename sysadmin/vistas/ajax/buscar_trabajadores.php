<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

use Illuminate\Support\Str;

/*-------------------------
Autor: Eduardo Vega
---------------------------*/

include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";
require_once "../funciones_destino.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Ventas";

permisos($modulo, $cadena_permisos);
// obtiene el dominio actual
$dominio = $_SERVER['HTTP_HOST'];
// se quitan los espacios en blanco 
$dominio = str_replace(' ', '', $dominio);

if (
    isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
) {
    $protocol = 'https://';
} else {
    $protocol = 'http://';
}
$server_url = $protocol . $_SERVER['HTTP_HOST'];
//Finaliza Control de Permisos
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax' && ($server_url == "https://marketplace.imporsuit.com" || $server_url == "https://einzas2.imporsuit.com")) {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q      = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $sTable = "empresa_envio, trabajadores_envio";
    $sWhere = "";
    $sWhere .= " WHERE trabajadores_envio.empresa=empresa_envio.id";

    if ($_GET['q'] != "") {
        $sWhere .= " and  (trabajadores_envio.nombre like '%$q%' or trabajadores_envio.contacto like '%$q%' or empresa_envio.nombre like '%$q%')";
    }

    if (@$_GET['estado'] != "") {
        $estado    = $_REQUEST['estado'];
        $sWhere .= " and  trabajadores_envio.estado='$estado'";
    }

    $sWhere .= " order by trabajadores_envio.id desc";
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page  = 10; //how much records you want to show
    if ($_GET["numero"]) {
        $per_page  = $_GET["numero"]; //how much records you want to show

    }
    $adjacents = 4; //gap between pages after number of adjacents
    $offset    = ($page - 1) * $per_page;

    $count_query = mysqli_query($conexion, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $row         = mysqli_fetch_array($count_query);
    $numrows     = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload      = '../reportes/facturas.php';
    //main query to fetch the data
    $sql   = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    //echo $sql;
    $query = mysqli_query($conexion, $sql);

    //loop through fetched data0
    if ($numrows > 0) {
        echo mysqli_error($conexion);

?>
        <div class="table-responsive">
            <table class="table table-sm table-striped align-middle">
                <tr class="info">
                    <th class="text-center"><input type="checkbox" onchange="checkall()" name="todos" id="todos"></th>
                    <th class="text-center"># Trabajador</th>
                    <th class="text-center">Empresa</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Contacto</th>
                    <th class="text-center">Placa</th>
                    <th colspan="2" style="text-align: center;">Estado</th>

                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($query)) {
                    print_r($row);
                }
                ?>
            </table>
        </div>
        <div class="table-pagination text-center">
            <?php
            echo paginate($reload, $page, $total_pages, $adjacents);
            ?>
        </div>
<?php
    } else {
        echo "<div class='alert alert-warning'>No se encontraron datos</div>";
    }
}
