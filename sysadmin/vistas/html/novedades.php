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
$modulo = "Categorias";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$title     = "Categorias";
$pacientes = 1;
?>


<?php require 'includes/header_start.php'; ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<style>
    .caja {
        padding-left: 40px !important;
        padding-right: 4px !important;
        border-radius: 0.5rem !important;
    }
</style>
<?php require 'includes/header_end.php'; ?>

<!-- Begin page -->
<div id="wrapper">

    <?php require 'includes/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container d-flex flex-column">
                <div>
                    <h1>Historial de Novedades</h1>
                </div>

                <div class="caja d-flex flex-row">
                    <div class="d-flex flex-column">
                        <div class="d-flex flex-row justify-content-start">
                            <div class="form-check mr-3">
                                <input type="checkbox" class="form-check-input" id="impuestos">
                                <label class="form-check-label" for="impuestos">Filtrar por Fecha de la orden</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="impuestos">
                                <label class="form-check-label" for="impuestos">Filtrar por Fecha de Solución</label>
                            </div>
                        </div>
                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" id="impuestos">
                            <label class="form-check-label" for="impuestos">Filtrar por Fecha de Novedad</label>
                        </div>
                    </div>
                    <div class="container">
                        <h2>Seleccione una fecha:</h2>
                        <div class="input-group date" id="datepicker">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
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
    <!-- Todo el codigo js aqui -->
    <!-- ============================================================== -->
    <script type="text/javascript" src="../../js/caracteristicas_entrega.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".UpperCase").on("keypress", function() {
                $input = $(this);
                setTimeout(function() {
                    $input.val($input.val().toUpperCase());
                }, 50);
            })
        })

        $(document).ready(function() {
            $('#datepicker').datepicker({
                format: "dd/mm/yyyy",
                language: "es",
                autoclose: true,
                todayHighlight: true
            });

            // Abrir el calendario al hacer clic en el icono
            $('#datepicker .input-group-append').click(function() {
                $('#datepicker').datepicker('show');
            });
        });
    </script>
    <?php require 'includes/footer_end.php'
    ?>