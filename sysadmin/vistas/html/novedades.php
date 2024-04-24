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
        padding-right: 40px !important;
        border-radius: 0.5rem !important;
        background-color: white;
    }

    .btn-excel {
        background-color: #1b6d41;
        color: white;
    }

    .btn-solucion {
        background-color: #FFD100;
        color: white;
    }

    hr {
        border: none;
        /* Quita el borde predeterminado */
        height: 2px;
        /* Ajusta el grosor de la línea */
        background-color: #000;
        /* Ajusta el color de la línea */
        margin: 20px 0;
        /* Ajusta el espaciado vertical de la línea */
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

                <div class="caja d-flex flex-column">
                    <div class="d-flex flex-row">
                        <div class="container" style="margin: 0; padding-left: 0;">
                            <h4>Seleccione fecha de inicio:</h4>
                            <div class="input-group date" id="datepickerInicio">
                                <input type="text" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="container" style="padding-left: 15px;">
                            <h4>Seleccione fecha de fin:</h4>
                            <div class="input-group date" id="datepickerFin">
                                <input type="text" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
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
                            <div class="form-check mt-2 d-flex flex-row-reverse">
                                <div>
                                    <input type="checkbox" class="form-check-input" id="impuestos">
                                    <label class="form-check-label" for="impuestos">Filtrar por Fecha de Novedad</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex flex-row">
                        <div class="d-flex flex-column" style="width: 100%;">
                            <div class="d-flex flex-row justify-content-start">
                                <div style="width: 100%;">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label" style="padding-left: 0;">Tienda</label>
                                    <div>
                                        <select class="form-control" name="alineacion_titulo" id="alineacion_titulo">
                                            <option value="1">Izquierda </option>
                                            <option value="2">Centro </option>
                                            <option value="3">Derecha </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div style="width: 100%;">
                                <label for="inputPassword3" class="col-sm-2 col-form-label" style="padding-left: 0;">Ciudad</label>
                                <div>
                                    <select class="form-control" name="alineacion_titulo" id="alineacion_titulo">
                                        <option value="1">Izquierda </option>
                                        <option value="2">Centro </option>
                                        <option value="3">Derecha </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="width: 100%;">
                            <label style="padding-left: 20px;" for="inputPassword3" class="col-sm-2 col-form-label">Estado</label>
                            <div style="padding-left: 20px;">
                                <select class="form-control" name="alineacion_titulo" id="alineacion_titulo">
                                    <option value="1">Izquierda </option>
                                    <option value="2">Centro </option>
                                    <option value="3">Derecha </option>
                                </select>
                            </div>
                        </div>
                        <div style="width: 100%;">
                            <label style="padding-left: 20px;" for="inputPassword3" class="col-sm-2 col-form-label">Departamento</label>
                            <div style="padding-left: 20px;">
                                <select class="form-control" name="alineacion_titulo" id="alineacion_titulo">
                                    <option value="1">Izquierda </option>
                                    <option value="2">Centro </option>
                                    <option value="3">Derecha </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div style="padding-top: 20px;">
                        <button type="button" class="btn btn-excel"><i class='bx bxs-spreadsheet'></i> Descargar en Excel</button>
                    </div>

                    <hr />

                    <div class="table-responsive" style="padding-top: 20px;">
                        <table class="table table-sm table-striped">
                            <tr class="info">

                                <th class="text-center">Orden</th>
                                <th class="text-center"># de Guia</th>
                                <th class="text-center">Transportadora</th>
                                <th class="text-center">Detalle</th>
                                <th class="text-center">Cliente</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Novedad</th>
                                <th class="text-center">Solución</th>
                                <th class="text-center">Tracking</th>

                            </tr>
                            <?php
                            $sql   = "SELECT * FROM  novedades";
                            //echo $sql;
                            $query = mysqli_query($conexion, $sql);
                            while ($row = mysqli_fetch_array($query)) {
                                $id_novedad     = $row['id_novedad'];
                                $numero_guia       = $row['guia_novedad'];
                                $cliente       = $row['cliente_novedad'];
                                $estado       = $row['estado_novedad'];
                                $novedad  = $row['novedad'];
                                $solucion  = $row['solucion_novedad'];
                                $tracking  = $row['tracking'];

                            ?>


                                <tr>
                                    <td class="text-center"><span class="badge badge-purple"><?php echo $id_novedad; ?></span></td>

                                    <td class="text-center"><?php echo $numero_guia; ?></td>


                                    <?php if (strpos($numero_guia, "IMP")  === 0) { ?>
                                        <td class="bg-warning text-center text-white">LAAR</td>
                                    <?php } else if (strpos($numero_guia, "FAST") === 0) { ?>
                                        <td class="bg-danger text-center text-white">SPEED</td>
                                    <?php } else if (is_numeric($numero_guia)) { ?>
                                        <td class="bg-success text-center text-white">SERVIENTREGA</td>
                                    <?php } ?>


                                    <td class="text-center"><?php echo "---"; ?></td>

                                    <td class="text-center"><?php echo $cliente ?></td>

                                    <td class="text-center"><?php echo $estado; ?></td>

                                    <td class="text-center"><?php echo $novedad; ?> <i class='bx bxs-down-arrow text-white cursor-pointer'></i></td>

                                    <td class="text-center">
                                        <button type="button" class="btn  btn-sm btn-solucion"><i class='bx bxs-shield-plus'></i> Solucion</button>
                                    </td>

                                    <td class="text-center">
                                        <a target="_blank" href="<?php echo $tracking; ?>" class="btn btn-sm  btn-warning">Ver tracking</a>
                                    </td>

                                </tr>
                            <?php
                            }
                            ?>
                        </table>
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
            // Inicializa el datepicker de fecha de inicio
            $('#datepickerInicio input').datepicker({
                format: "dd/mm/yyyy",
                language: "es",
                autoclose: true,
                todayHighlight: true
            }).on('changeDate', function(selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#datepickerFin input').datepicker('setStartDate', minDate);
            });

            // Inicializa el datepicker de fecha de fin
            $('#datepickerFin input').datepicker({
                format: "dd/mm/yyyy",
                language: "es",
                autoclose: true,
                todayHighlight: true
            });

            // Manejador para abrir el calendario al hacer clic en el ícono
            $('.input-group-text').click(function() {
                $(this).parent().prev('input').datepicker('show');
            });
        });
    </script>
    <?php require 'includes/footer_end.php'
    ?>