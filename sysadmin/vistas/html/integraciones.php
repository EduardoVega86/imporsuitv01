<?php
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../../login.php");
    exit;
}
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Integraciones";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
/*$count      = mysqli_query($conexion, "select MAX(codigo_producto) as codigo from productos");
$rw         = mysqli_fetch_array($count);
$product_id = $rw['codigo'] + 1;
//consulta para elegir el impuesto en la modal
$query    = $conexion->query("select * from impuestos");
$impuesto = array();
while ($r = $query->fetch_object()) {
    $impuesto[] = $r;
}
*/
?>
<?php require 'includes/header_start.php'; ?>

<?php require 'includes/header_end.php'; ?>

<!-- Begin page -->
<div id="wrapper" class="forced enlarged"> <!-- DESACTIVA EL MENU -->

    <?php require 'includes/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <?php if ($permisos_ver == 1) {
                ?>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col bg-white rounded-5 shadow-xl m-3 py-3 px-4">
                                <div class="grid items-center">

                                    <img src="https://cdn.icon-icons.com/icons2/836/PNG/512/Shopify_icon-icons.com_66757.png" width="30px" alt="img">
                                    <h3 class="text-left font-bold">Shopify
                                </div>

                                </h3>
                                <p>Añade automaticamente tus pedidos de shopify con nuestra api.</p>
                                <div class="d-flex flex-column gap-1">
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#Shopify">
                                        Conectar
                                    </button>
                                    <a href="https://www.youtube.com/watch?v=2jKBA8kjEvo" target="_blank" class="btn btn-outline-danger">Ver Video</a>
                                </div>
                            </div>
                            <div class="col bg-white rounded-5 shadow-xl m-3 py-3 px-4">
                                <div class="grid items-center">

                                    <img src="https://cdn.icon-icons.com/icons2/2429/PNG/512/facebook_logo_icon_147291.png" width="30px" alt="img">
                                    <h3 class="text-left font-bold">Facebook
                                </div>

                                </h3>
                                <p>Manten actualizadas tus campañas con nuestra api.</p>
                                <div class="d-flex flex-column gap-1">
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#facebook">
                                        Proximamente
                                    </button>
                                    <!-- <a href="#" class="btn btn-outline-danger">Ver Video</a> -->
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="facebook" tabindex="-1" role="dialog" aria-labelledby="facebookLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="facebookLabel">Conectar con Facebook</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="mb-3">

                                                <span class="mb-5">
                                                    Introduce tu ID de píxel de Facebook para hacer un seguimiento de las acciones que tus clientes realizan mientras visitan tu sitio web
                                                </span>
                                                <span class="mb-5 font-bold"> <br> Facebook Pixel ID</span>
                                                <div class="form-group mb-3">

                                                    <input type="text" class="form-control" placeholder="ID de píxel de Facebook">
                                                </div>

                                                <div class="form-group px-5">
                                                    <input class="form-check-input" type="checkbox" name="habilitar_api" id="habilitar_api">
                                                    <label class="form-label" for="habilitar_api">Habilitar conversiones API <br>
                                                        <span class="fs-xs">Recomendado, envia eventos directamente desde nuestros servidores.</span>
                                                    </label>
                                                </div>

                                                <span class="font-bold">
                                                    Token de acceso a la API de conversiones <br>
                                                </span>
                                                <span class="mb-5">
                                                    Introduce tu token de acceso de Facebook para hacer un seguimiento de las acciones que tus clientes realizan mientras visitan tu sitio web
                                                </span>
                                                <div class="form-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Token de acceso de Facebook">
                                                </div>

                                                <span class="font-bold">
                                                    Probar la API de conversiones <br>
                                                </span>
                                                <span class="mb-5">
                                                    Para probar los eventos del servidor, copia y pega aquí tu código de prueba de Facebook y haz clic en el botón "Guardar y probar", si todo está bien, verás un evento de prueba en el registro de eventos de tu píxel.
                                                </span>

                                                <div class="form-group">
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                </div>

                                                <div class="d-flex justify-content-center">
                                                    <button type="button">Desconectar</button>
                                                    <button type="button" class="btn btn-outline-primary">Guardar y probar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="Shopify" tabindex="-1" role="dialog" aria-labelledby="ShopifyLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ShopifyLabel">Conectar con Shopify</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php
                                            $url_actual = "https://" . $_SERVER["HTTP_HOST"];

                                            ?>
                                            Ingresa la siguiente url en tu tienda de shopify: <br>
                                            <input type="text" class="form-control" value="<?php echo $url_actual; ?>/sysadmin/api/integracion/Shopify" readonly>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php
                } else {
                ?>
                    <section class="content">
                        <div class="alert alert-danger" align="center">
                            <h3>Acceso denegado! </h3>
                            <p>No cuentas con los permisos necesario para acceder a este módulo.</p>
                        </div>
                    </section>
                <?php
                }
                ?>

            </div>
            <!-- end container -->
        </div>
        <!-- end content -->

        <?php require 'includes/pie.php'; ?>

    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<?php require 'includes/footer_start.php'
?>
<!-- ============================================================== -->
<!-- Todo el codigo js aqui-->
<!-- ============================================================== -->
<script type="text/javascript" src="../../js/VentanaCentrada.js"></script>

<?php require 'includes/footer_end.php'
?>