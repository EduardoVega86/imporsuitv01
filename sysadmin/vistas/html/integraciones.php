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
                                    <h3 class="text-left font-bold">Titulo
                                </div>

                                </h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, dolore consequuntur autem delectus deleniti repellat, in accusamus odio obcaecati tempora mollitia voluptate nam vitae illo unde. Vel ab soluta tempora.</p>
                                <div class="grid grid-cols-2">
                                    <a href="#" class="btn btn-outline-primary">Conectar</a><a href="#" class="btn btn-outline-danger">Ver Video</a>
                                </div>
                            </div>
                            <div class="col bg-white rounded-5 shadow-xl m-3 py-3 px-4">
                                <div class="grid items-center">

                                    <img src="https://cdn.icon-icons.com/icons2/836/PNG/512/Shopify_icon-icons.com_66757.png" width="30px" alt="img">
                                    <h3 class="text-left font-bold">Titulo
                                </div>

                                </h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, dolore consequuntur autem delectus deleniti repellat, in accusamus odio obcaecati tempora mollitia voluptate nam vitae illo unde. Vel ab soluta tempora.</p>
                                <div class="grid grid-cols-2">
                                    <a href="#" class="btn btn-outline-primary">Conectar</a><a href="#" class="btn btn-outline-danger">Ver Video</a>
                                </div>
                            </div>
                            <div class="col bg-white rounded-5 shadow-xl m-3 py-3 px-4">
                                <div class="grid items-center">

                                    <img src="https://cdn.icon-icons.com/icons2/836/PNG/512/Shopify_icon-icons.com_66757.png" width="30px" alt="img">
                                    <h3 class="text-left font-bold">Titulo
                                </div>

                                </h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, dolore consequuntur autem delectus deleniti repellat, in accusamus odio obcaecati tempora mollitia voluptate nam vitae illo unde. Vel ab soluta tempora.</p>
                                <div class="grid grid-cols-2">
                                    <a href="#" class="btn btn-outline-primary">Conectar</a><a href="#" class="btn btn-outline-danger">Ver Video</a>
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