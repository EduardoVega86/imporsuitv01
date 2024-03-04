<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


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
$modulo = "Tiendas";

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
if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q      = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $sTable = "plataformas";
    $sWhere = "";
    $sWhere .= " WHERE url_imporsuit = '" . $dominio . "' ";

    $sWhere .= " order by id_plataforma asc";
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page  = 10; //how much records you want to show

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
        $row3;
        echo mysqli_error($conexion);

?>
        <div class="table-responsive">
            <table class="table table-sm table-striped align-middle">
                <tr class="info">
                    <th class="text-center">N° Tienda</th>
                    <th class="text-center">Nombre de la Tienda</th>
                    <th class="text-center">Dominio</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($query)) {

                    $token_pagina = $row['token_pagina'];

                    $buscar = "SELECT * FROM tiendas WHERE token_pagina = '$token_pagina'";
                    $result = mysqli_query($conexion, $buscar);
                    $row2 = mysqli_fetch_assoc($result);
                    $row3 = $row2;
                    while ($row2 = mysqli_fetch_assoc($result)) {
                        $id_tienda = $row2['id_tienda'];
                        $nombre_tienda = $row2['nombre_tienda'];
                        $dominio_tienda = $row2['dominio_tienda'];
                ?>
                        <tr>
                            <td class='text-center'><?php echo $id_tienda; ?></td>
                            <td class='text-center'><?php echo $nombre_tienda; ?></td>
                            <td class='text-center'><?php echo $dominio_tienda; ?></td>
                        </tr>
                <?php
                    }
                }
                $plan = $row['plan'];
                if (count($row2) != 3 && $plan = 3 || count($row2) != 9 && $plan = 4) {
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
    ?>


        <div class='alert alert-warning'>No se encontraron datos</div>

<?php
    }
}
