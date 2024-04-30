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
$modulo = "Inicio";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$title  = "Inicio";
$Inicio = 1;
//Archivo de funciones PHP
// dominio mas protocolo
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

$dominio_completo =     $protocol . $_SERVER['HTTP_HOST'];

$conexion_marketplace = new mysqli('localhost', 'imporsuit_marketplace', 'imporsuit_marketplace', 'imporsuit_marketplace');

require_once "../funciones.php";
$usu            = $_SESSION['id_users'];
$users_users    = get_row('users', 'usuario_users', 'id_users', $usu);
$cargo_users    = get_row('users', 'cargo_users', 'id_users', $usu);
$nombre_users   = get_row('users', 'nombre_users', 'id_users', $usu);
$apellido_users = get_row('users', 'apellido_users', 'id_users', $usu);
$email_users    = get_row('users', 'email_users', 'id_users', $usu);
?>
<?php require 'includes/header_start.php'; ?>
<!-- grafico -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom"></script>
<style>
    .card-box {
        border-radius: 0.5rem !important;
    }

    .carousel-item {
        position: relative;
        width: 100%;
        height: 400px;
        /* o la altura que prefieras */
    }

    .carousel-item img {
        position: absolute;
        top: 50%;
        left: 50%;
        width: auto;
        /* Esto mantendrá la relación de aspecto de la imagen */
        height: auto;
        /* Esto mantendrá la relación de aspecto de la imagen */
        min-height: 100%;
        min-width: 100%;
        transform: translate(-50%, -50%);
        object-fit: cover;
        /* Esto cortará la parte extra de las imágenes */
    }

    canvas {
        height: auto;
        max-height: 100%;
        /* Asegúrate de que el canvas no sobrepase el tamaño del portlet-body */
    }

    .portlet-body {
        max-height: 400px;
        /* Ajusta este valor según lo que necesites */
        overflow-y: auto;
        /* Crea un desplazamiento vertical si el contenido supera el alto máximo */
    }

    /* Opcional: para asegurarse de que todas las cajas 'portlet' tengan el mismo tamaño */
    .portlet {
        display: flex;
        flex-direction: column;
    }

    .portlet-heading {
        flex-shrink: 0;
        /* Esto evita que el encabezado se contraiga */
    }

    .portlet-body {
        flex-grow: 1;
        /* Esto permite que el cuerpo de la caja crezca para ocupar el espacio disponible */
    }

    .portlet-fixed-height {
        height: 240px;
        /* Establece la altura deseada */
        display: flex;
        flex-direction: column;
    }

    .portlet-body-fixed-height {
        flex-grow: 1;
        /* Asegura que el cuerpo se expanda para llenar la caja */
        overflow-y: auto;
        /* Permite desplazamiento vertical si es necesario */
    }

    /* slider */
    .carousel-item::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.3);
        /* Cambia el color y la opacidad según necesites */
        z-index: 1;
    }

    .carousel-item img {
        width: 100%;
        height: auto;
        display: block;
    }

    .carousel-caption {
        z-index: 2;
        /* Asegura que el texto está sobre la capa oscura */
        position: relative;
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
            <div class="container">
                <?php if ($permisos_ver == 1) {
                ?>
                    <br>
                    <div class="d-flex flex-row">
                        <div class="d-flex flex-column" style="width: 40%;">
                            <div class="d-flex flex-row">
                                <div class="col">

                                    <div class="widget-bg-color-icon card-box">
                                        <div class="bg-icon bg-icon-success pull-left">
                                            <i class="ti-receipt text-success"></i>
                                        </div>
                                        <div class="text-right">
                                            <?php
                                            $query = mysqli_query($conexion, "SELECT COUNT(*) as count FROM facturas_cot");
                                            $rw = mysqli_fetch_array($query);
                                            $total_ventas = $rw['count'];
                                            ?>
                                            <h5 class="text-dark text-center"><b id="total_pedido_filtro" class="counter text-success"><?php echo $total_ventas; ?></b></h5>
                                            <p class="text-muted mb-0">Total Ventas</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>


                                <div class="col">

                                    <div class="widget-bg-color-icon card-box">
                                        <div class="bg-icon bg-icon-danger pull-left">
                                            <i class="bx bx-receipt text-pink"></i>
                                        </div>
                                        <div class="text-right">
                                            <?php
                                            $query = mysqli_query($conexion, "SELECT COUNT(*) as count FROM guia_laar");
                                            $rw = mysqli_fetch_array($query);
                                            $total_guias = $rw['count'];
                                            ?>
                                            <h5 class="text-dark text-center"><b class="counter text-pink"><?php echo $total_guias; ?></b></h5>
                                            <p class="text-muted mb-0">Total Guias</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                            </div>


                            <div class="d-flex flex-row">
                                <div class="col">

                                    <div class="widget-bg-color-icon card-box fadeInDown animated">
                                        <div class="bg-icon bg-icon-primary pull-left">
                                            <i class=" ti-wallet text-info"></i>
                                        </div>
                                        <div class="text-right">
                                            <?php
                                            $query = mysqli_query($conexion_marketplace, "SELECT 
                                        SUM(CASE WHEN subquery.numero_factura NOT LIKE 'proveedor%' AND subquery.numero_factura NOT LIKE 'referido%' THEN subquery.total_venta ELSE 0 END) AS total_ventas,
                                        SUM(subquery.total_pendiente) AS total_pendiente, -- Se incluyen todas las facturas
                                        SUM(CASE WHEN subquery.numero_factura NOT LIKE 'proveedor%' AND subquery.numero_factura NOT LIKE 'referido%' THEN subquery.total_cobrado ELSE 0 END) AS total_cobrado,
                                        SUM(CASE WHEN subquery.numero_factura NOT LIKE 'proveedor%' AND subquery.numero_factura NOT LIKE 'referido%' THEN subquery.monto_recibir ELSE 0 END) AS monto_recibir
                                    FROM (
                                        SELECT 
                                            numero_factura, 
                                            MAX(total_venta) AS total_venta, 
                                            MAX(valor_pendiente) AS total_pendiente, 
                                            MAX(valor_cobrado) AS total_cobrado, 
                                            MAX(monto_recibir) AS monto_recibir
                                        FROM cabecera_cuenta_pagar 
                                        WHERE tienda = '$dominio_completo' 
                                            AND visto = '1'
                                        GROUP BY numero_factura
                                    ) AS subquery;");
                                            $rw = mysqli_fetch_array($query);
                                            $total_recaudo = $rw['total_ventas'];
                                            $total_recaudo_formateado = number_format($total_recaudo, 2, '.', ',');
                                            ?>
                                            <h5 class="text-dark"><b class="counter text-info">$ <?php echo $total_recaudo_formateado; ?></b></h5>
                                            <p class="text-muted mb-0">Total Recaudo</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>

                                <div class="col">

                                    <div class="widget-bg-color-icon card-box">
                                        <div class="bg-icon bg-icon-purple pull-left">
                                            <i class="ti-truck text-purple"></i>
                                        </div>
                                        <div class="text-right">
                                        <?php
                                            $query = mysqli_query($conexion_marketplace, "SELECT 
                                             SUM(CASE WHEN subquery.numero_factura NOT LIKE 'proveedor%' AND subquery.numero_factura NOT LIKE 'referido%' THEN subquery.total_venta ELSE 0 END) AS total_ventas,
                                             SUM(subquery.total_pendiente) AS total_pendiente, -- Se incluyen todas las facturas
                                             SUM(CASE WHEN subquery.numero_factura NOT LIKE 'proveedor%' AND subquery.numero_factura NOT LIKE 'referido%' THEN subquery.total_cobrado ELSE 0 END) AS total_cobrado,
                                             SUM(CASE WHEN subquery.numero_factura NOT LIKE 'proveedor%' AND subquery.numero_factura NOT LIKE 'referido%' THEN subquery.total_cobrado ELSE 0 END) AS total_cobrado,
                                             SUM(CASE WHEN subquery.numero_factura NOT LIKE 'proveedor%' AND subquery.numero_factura NOT LIKE 'referido%' THEN subquery.monto_recibir ELSE 0 END) AS monto_recibir,
                                             (SELECT SUM(precio_envio) as total_fletes from cabecera_cuenta_pagar where visto =1 and estado_guia = 9 and tienda = '$dominio_completo') as total_fletes
                                             FROM (
                                                SELECT 
                                                numero_factura, 
                                                MAX(total_venta) AS total_venta, 
                                                MAX(valor_pendiente) AS total_pendiente, 
                                                MAX(valor_cobrado) AS total_cobrado, 
                                                MAX(monto_recibir) AS monto_recibir 
                                                FROM cabecera_cuenta_pagar 
                                                WHERE tienda = '$dominio_completo' 
                                                AND visto = '1'
                                            GROUP BY numero_factura
                                             ) AS subquery;");
                                            $rw = mysqli_fetch_array($query);
                                            $total_fletes = $rw['total_fletes'];
                                            $total_fletes_formateado = number_format($total_fletes, 2, '.', ',');
                                            ?>
                                            <h5 class="text-dark text-center"><b class="counter text-purple"><?php echo $total_fletes; ?></b></h5>
                                            <p class="text-muted mb-0">Total Fletes</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex flex-row">
                                <div class="col">

                                    <div class="widget-bg-color-icon card-box fadeInDown animated">
                                        <div class="bg-icon bg-icon-primary pull-left">
                                            <i class=" ti-back-left text-info"></i>
                                        </div>
                                        <div class="text-right">
                                            <?php
                                            $query = mysqli_query($conexion_marketplace, "SELECT 
                                             SUM(CASE WHEN subquery.numero_factura NOT LIKE 'proveedor%' AND subquery.numero_factura NOT LIKE 'referido%' THEN subquery.total_venta ELSE 0 END) AS total_ventas,
                                             SUM(subquery.total_pendiente) AS total_pendiente, -- Se incluyen todas las facturas
                                             SUM(CASE WHEN subquery.numero_factura NOT LIKE 'proveedor%' AND subquery.numero_factura NOT LIKE 'referido%' THEN subquery.total_cobrado ELSE 0 END) AS total_cobrado,
                                             SUM(CASE WHEN subquery.numero_factura NOT LIKE 'proveedor%' AND subquery.numero_factura NOT LIKE 'referido%' THEN subquery.total_cobrado ELSE 0 END) AS total_cobrado,
                                             SUM(CASE WHEN subquery.numero_factura NOT LIKE 'proveedor%' AND subquery.numero_factura NOT LIKE 'referido%' THEN subquery.monto_recibir ELSE 0 END) AS monto_recibir,
                                             (SELECT SUM(monto_recibir) as devolucion from cabecera_cuenta_pagar where visto =1 and estado_guia = 9 and tienda = '$dominio_completo') as devolucion
                                             FROM (
                                                SELECT 
                                                numero_factura, 
                                                MAX(total_venta) AS total_venta, 
                                                MAX(valor_pendiente) AS total_pendiente, 
                                                MAX(valor_cobrado) AS total_cobrado, 
                                                MAX(monto_recibir) AS monto_recibir 
                                                FROM cabecera_cuenta_pagar 
                                                WHERE tienda = '$dominio_completo' 
                                                AND visto = '1'
                                            GROUP BY numero_factura
                                             ) AS subquery;");
                                            $rw = mysqli_fetch_array($query);
                                            $total_devoluciones = $rw['devolucion'];
                                            $total_devoluciones_formateado = number_format($total_devoluciones, 2, '.', ',');
                                            ?>
                                            <h5 class="text-dark"><b class="counter text-info">$ <?php echo $total_devoluciones_formateado; ?></b></h5>
                                            <p class="text-muted mb-0">Devoluciones</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>

                                <div class="col">

                                    <div class="widget-bg-color-icon card-box">
                                        <div class="bg-icon bg-icon-purple pull-left">
                                            <i class="ti-dashboard text-purple"></i>
                                        </div>
                                        <div class="text-right">
                                            <h5 class="text-dark text-center"><b class="counter text-purple"><?php total_cxc(); ?></b></h5>
                                            <p class="text-muted mb-0"> Fulfillment</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Slider infinito -->
                        <div class="slider" style="width: 60%; margin-bottom:20px; background-color:white;">
                            <div id="miSlider" class="carousel slide" data-ride="carousel">
                                <!-- Indicadores -->
                                <ol class="carousel-indicators">
                                    <?php
                                    $sql = "SELECT * FROM banner_marketplace";
                                    $result = $conexion->query($sql);
                                    $i = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<li data-target="#miSlider" data-slide-to="' . $i . '"' . ($i == 0 ? ' class="active"' : '') . '></li>';
                                        $i++;
                                    }
                                    ?>
                                </ol>

                                <!-- Slides -->
                                <div class="carousel-inner">
                                    <?php
                                    $first = true;
                                    $result = $conexion->query($sql); // Volver a ejecutar la consulta
                                    while ($row = $result->fetch_assoc()) {
                                        $alignment = ['1' => 'text-left', '2' => 'text-center', '3' => 'text-right'][$row['alineacion']] ?? 'text-center';
                                        echo '<div class="carousel-item' . ($first ? ' active' : '') . '">';
                                        echo '<img src="' . $row['fondo_banner'] . '" class="d-block w-100" alt="...">';
                                        echo '<div class="carousel-caption d-none d-md-block ' . $alignment . '">';
                                        echo '<h5 style="color: white;">' . $row['titulo'] . '</h5>';
                                        echo '<p style="color: white;">' . $row['texto_banner'] . '</p>';
                                        echo '<a style="color: white; background-color: #171931; border-color: #171931;" href="' . $row['enlace_boton'] . '" class="btn btn-primary">' . $row['texto_boton'] . '</a>';
                                        echo '</div></div>';
                                        $first = false;
                                    }
                                    ?>
                                </div>

                                <!-- Controles -->
                                <a class="carousel-control-prev" href="#miSlider" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Anterior</span>
                                </a>
                                <a class="carousel-control-next" href="#miSlider" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Siguiente</span>
                                </a>
                            </div>
                        </div>

                        <!-- Fin de Slider infinito -->
                    </div>
                    <!-- end row -->

                    <div class="d-flex flex-row">

                        <div class="col-lg-4">
                            <div class="portlet portlet-fixed-height">
                                <div class="portlet-heading bg-purple">
                                    <h3 class="portlet-title">
                                        Ultimos Pedidos
                                    </h3>
                                    <div class="portlet-widgets">
                                        <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                        <span class="divider"></span>
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#bg-primary"><i class="ion-minus-round"></i></a>
                                        <span class="divider"></span>
                                        <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="bg-primary" class="panel-collapse collapse show">
                                    <div class="portlet-body portlet-fixed-height">
                                        <div class="table-responsive">
                                            <table class="table table-sm no-margin table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No. Pedido</th>
                                                        <th>Fecha</th>
                                                        <th class="text-center">Monto</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    ultimos_pedidos();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div><!-- /.table-responsive -->
                                        <div class="box-footer clearfix">
                                            <a href="bitacora_cotizacion.php" class="btn btn-sm btn-danger btn-flat pull-right">Ver todas las Ventas</a>
                                        </div><!-- /.box-footer -->
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="card-box widget-user">
                                <div>
                                    <img src="../../assets/images/users/avatar-1.jpg" class="rounded-circle" alt="user">
                                    <div class="wid-u-info">
                                        <h5 class="mt-0 m-b-5 font-16">Mis Ventas del día</h5>
                                        <p class="text-muted m-b-5 font-16"><?php venta_users(); ?></p>
                                        <small class="text-warning"><b><?php echo $nombre_users . ' ' . $apellido_users ?></b></small>
                                    </div>
                                </div>
                            </div> -->
                        </div>

                        <div class="col-lg-4">
                            <div class="portlet portlet-fixed-height">
                                <div class="portlet-heading bg-purple">
                                    <h3 class="portlet-title">
                                        Ventas del ultimo Mes
                                    </h3>
                                    <div class="portlet-widgets">
                                        <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                        <span class="divider"></span>
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#bg-primary"><i class="ion-minus-round"></i></a>
                                        <span class="divider"></span>
                                        <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="bg-primary" class="panel-collapse collapse show">
                                    <div class="portlet-body portlet-fixed-height">
                                        <canvas id="salesChart" height="200"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="portlet portlet-fixed-height">
                                <div class="portlet-heading bg-purple">
                                    <h3 class="portlet-title">
                                        Visitas
                                    </h3>
                                    <div class="portlet-widgets">
                                        <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                        <span class="divider"></span>
                                        <a data-toggle="collapse" data-parent="#accordion1" href="#bg-primary"><i class="ion-minus-round"></i></a>
                                        <span class="divider"></span>
                                        <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div id="bg-primary" class="panel-collapse collapse show">
                                    <div class="portlet-body portlet-fixed-height">
                                        <div class="table-responsive">
                                            <table class="table table-sm no-margin table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Pagina</th>

                                                        <th class="text-center">Visitas</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    visitas();
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div><!-- /.table-responsive -->

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cambio de correo</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body mb-3 px-4">
                                    <span class="text-muted">
                                        <p class="text-justify">Estimado usuario, estamos transicionando hacia una nueva version, por lo cual hemos detectado que nos faltan algunos datos de tu empresa, recomandamos llenar los datos.</p>
                                    </span>
                                </div>
                                <div class="px-3">
                                    <form class="" onsubmit="modificar_email(event)">
                                        <div class="mb-3">
                                            <label for="email">Correo</label>
                                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="cedula">Cédula</label>
                                            <input type="text" class="form-control" id="cedula" aria-describedby="cedulaHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" class="form-control" id="direccion" aria-describedby="direccionHelp">
                                        </div>
                                        <div class="mb-3 d-grid">
                                            <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalDataLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalDataLabel">Cambio de correo</h1>
                                </div>
                                <div class="modal-body mb-3 px-4">
                                    <span class="text-muted">
                                        <p class="text-justify">Estimado usuario, estamos transicionando hacia una nueva version, por lo cual hemos detectado que nos hace falta información de tu tienda.</p>
                                    </span>
                                </div>
                                <div class="px-3">
                                    <form class="" onsubmit="modificar_info(event)">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title">Información de la tienda</h5>
                                            </div>

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nombre">Nombre</label>
                                                            <input type="text" class="form-control" id="nombre">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="telefono">Teléfono</label>
                                                            <input type="text" class="form-control" id="telefono">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo">Correo</label>
                                                    <input type="text" class="form-control" id="correo">
                                                </div>
                                                <div class="form-group">
                                                    <label for="enlace">Enlace</label>
                                                    <input type="text" class="form-control" id="enlace">
                                                </div>
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>


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


<?php require 'includes/footer_start.php'; ?>
<!-- ============================================================== -->
<!-- Todo el codigo js aqui-->
<!-- ============================================================== -->


<script>
    $(function() {
        load(1);

        //Date range picker
        $('.daterange').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-success',
            cancelClass: 'btn-default',
            locale: {
                format: "DD/MM/YYYY",
                separator: " - ",
                applyLabel: "Aplicar",
                cancelLabel: "Cancelar",
                fromLabel: "Desde",
                toLabel: "Hasta",
                customRangeLabel: "Custom",
                daysOfWeek: [
                    "Do",
                    "Lu",
                    "Ma",
                    "Mi",
                    "Ju",
                    "Vi",
                    "Sa"
                ],
                monthNames: [
                    "Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre"
                ],
                firstDay: 1
            },
            opens: "right"

        });
    });

    function load() {}



    function modificar_info(e) {
        e.preventDefault();
        var nombre = $("#nombre").val();
        var telefono = $("#telefono").val();
        var correo = $("#correo").val();
        var enlace = $("#enlace").val();
        $.ajax({
            type: 'POST',
            url: '../ajax/actualizar_info_tienda.php',
            contentType: 'application/json', // Especifica el tipo de contenido
            data: JSON.stringify({ // Convierte los datos a una cadena JSON
                nombre: nombre,
                telefono: telefono,
                correo: correo,
                enlace: enlace,
                action: 'ajax'
            }),
            dataType: 'json',
            async: false,
            success: function(response) {
                if (response.status == "actualizado") {
                    Swal.fire({
                        title: "¡Datos actualizados!",
                        text: "Se ha actualizado correctamente, por favor inicia sesión nuevamente.",
                        icon: "success",
                        textConfirm: "Aceptar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "../../login.php?logout";
                        }
                    })
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        text: "No se ha podido actualizar los datos, por favor intente nuevamente.",
                        icon: "error",
                        textConfirm: "Aceptar",
                    })
                }
            }
        })
    }

    function cambiar() {
        //alert($("#range").val());
        var range = $("#range").val();
        var parametros = {
            "action": "ajax",
            'range': range
        };
        $("#loader").fadeIn('slow');
        $.ajax({
            url: '../ajax/rep_principal.php',
            data: parametros,
            beforeSend: function(objeto) {
                $("#loader").html("<img src='../../img/ajax-loader.gif'>");
            },
            success: function(data) {
                //$(".outer_div").html(data).fadeIn('slow');
                $("#total_pedido_filtro").html(data);
            }
        })

    }
</script>
<script>
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawVisualization2);
    google.charts.setOnLoadCallback(drawVisualization);

    function errorHandler(errorMessage) {
        //curisosity, check out the error in the console
        console.log(errorMessage);
        //simply remove the error, the user never see it
        google.visualization.errors.removeError(errorMessage.id);
    }

    function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var periodo = $("#periodo").val(); //Datos que enviaremos para generar una consulta en la base de datos
        var jsonData = $.ajax({
            url: 'chart.php',
            data: {
                'periodo': periodo,
                'action': 'ajax'
            },
            dataType: 'json',
            async: false
        }).responseText;

        var obj = jQuery.parseJSON(jsonData);
        var data = google.visualization.arrayToDataTable(obj);



        var options = {
            title: 'VENTAS VS COMPRAS' + periodo,
            vAxis: {
                title: 'Monto'
            },
            hAxis: {
                title: 'Meses'
            },
            seriesType: 'bars',
            series: {
                5: {
                    type: 'line'
                }
            }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        google.visualization.events.addListener(chart, 'error', errorHandler);
        chart.draw(data, options);
    }

    // Haciendo los graficos responsivos
    jQuery(document).ready(function() {
        jQuery(window).resize(function() {
            drawVisualization();
        });
    });

    function drawVisualization2() {
        // Some raw data (not necessarily accurate)
        var periodo = $("#periodo2").val(); //Datos que enviaremos para generar una consulta en la base de datos
        var jsonData = $.ajax({
            url: 'comparativa2.php',
            data: {
                'periodo': periodo,
                'action': 'ajax'
            },
            dataType: 'json',
            async: false
        }).responseText;

        var obj = jQuery.parseJSON(jsonData);
        var data = google.visualization.arrayToDataTable(obj);



        var options = {
            title: 'PEDIDOS VS VENTAS' + periodo,
            vAxis: {
                title: 'Monto'
            },
            hAxis: {
                title: 'Meses'
            },
            seriesType: 'bars',
            series: {
                5: {
                    type: 'line'
                }
            }
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div2'));
        google.visualization.events.addListener(chart, 'error', errorHandler);
        chart.draw(data, options);
    }



    function drawVisualization3() {
        $.ajax({
            url: 'comparativa3.php',
            data: {
                'action': 'ajax'
            },
            dataType: 'json',
            async: false,
            success: function(response) {
                // Carga la librería de Google Charts
                google.charts.load('current', {
                    'packages': ['corechart']
                });

                // Llama a la función para dibujar el gráfico de pastel cuando la librería esté lista
                google.charts.setOnLoadCallback(function() {
                    // Convierte los datos a un objeto DataTable
                    var data = google.visualization.arrayToDataTable(response);

                    // Opciones del gráfico de pastel
                    var options = {
                        title: 'Distribución de estados de guías de envío',
                    };

                    // Crea y dibuja el gráfico de pastel en el elemento con ID 'chart_div3'
                    var chart = new google.visualization.PieChart(document.getElementById('chart_div3'));
                    chart.draw(data, options);
                });
            }
        });
    }

    drawVisualization3();
</script>

<script>
    var item = localStorage.getItem('email');

    if (item == null) {
        $.ajax({
            url: '../ajax/actualizar_email.php',
            data: {
                'action': 'ajax'
            },
            dataType: 'json',
            async: false,
            success: function(response) {
                localStorage.setItem('email', response.email);
                if (response.status == "cambio") {
                    $('#staticBackdrop').modal('show');
                }
            }
        })
    } else if (item === "root@admin.com") {
        localStorage.removeItem('email');
    } else {
        console.log("xd");
        if (!validarEmail(item)) {
            $.ajax({
                url: '../ajax/actualizar_email.php',
                data: {
                    'action': 'ajax'
                },
                dataType: 'json',
                async: false,
                success: function(response) {
                    localStorage.setItem('email', response.email);
                    if (response.status == "cambio") {
                        $('#staticBackdrop').modal('show');
                    }
                }
            })

        }
    }

    function validarEmail(email) {
        var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return regex.test(email);
    }



    var maestro = localStorage.getItem('maestro');
    if (maestro == null) {
        $.ajax({
            url: '../ajax/actualizar_maestro.php',
            data: {
                'action': 'ajax'
            },
            dataType: 'json',
            async: false,
            success: function(response) {
                localStorage.setItem('maestro', response.maestro);

            }
        })
    }

    function modificar_email(e) {
        e.preventDefault();
        var email = $("#email").val();
        var cedula = $("#cedula").val();
        var direccion = $("#direccion").val();
        $.ajax({
            type: 'POST',
            url: '../ajax/actualizar_email.php',
            contentType: 'application/json', // Especifica el tipo de contenido
            data: JSON.stringify({ // Convierte los datos a una cadena JSON
                email: email,
                cedula: cedula,
                direccion: direccion,
                action: 'ajax'
            }),
            dataType: 'json',
            async: false,
            success: function(response) {
                if (response.status == "actualizado") {
                    localStorage.setItem('email', response.email);
                    Swal.fire({
                        title: "¡Correo actualizado!",
                        text: "Se ha actualizado correctamente, por favor inicia sesión nuevamente.",
                        icon: "success",
                        textConfirm: "Aceptar",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = "../../login.php?logout";
                        }
                    })
                } else {
                    Swal.fire({
                        title: "¡Error!",
                        text: "No se ha podido actualizar el correo, por favor intente nuevamente.",
                        icon: "error",
                        textConfirm: "Aceptar",
                    })
                }
            }
        })
    }
</script>

<script>
    if (localStorage.getItem('datos') == null) {
        fetch('../ajax/info_tienda_existe.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                action: 'ajax'
            })
        }).then(response => response.json()).then(data => {
            if (data === "cambios") {

                $('#modalData').modal({
                    backdrop: 'static',
                    keyboard: false,
                    show: true
                });
            } else {
                localStorage.setItem('datos', "existe");
            }
        })

    }
    //dashboard ventan mensuales
    <?php
    $query_fecha = "SELECT fecha_factura, SUM(monto_factura) AS total_venta FROM facturas_cot WHERE fecha_factura >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) GROUP BY fecha_factura ORDER BY fecha_factura ASC";
    $result = mysqli_query($conexion, $query_fecha);

    $fechas = [];
    $ventas = [];
    while ($row_fecha = mysqli_fetch_assoc($result)) {
        $fechas[] = date('j M', strtotime($row_fecha['fecha_factura'])); // Formatea la fecha como '1 Nov'
        $ventas[] = $row_fecha['total_venta'];
    }
    ?>
    var fechas = <?php echo json_encode($fechas); ?>;
    var ventas = <?php echo json_encode($ventas); ?>;

    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: fechas, // Tus etiquetas de fecha aquí
            datasets: [{
                label: 'Ventas este mes',
                data: ventas, // Tus datos de ventas aquí
                fill: true, // Habilita el sombreado debajo de la línea
                backgroundColor: 'rgba(0, 123, 255, 0.2)', // Color de fondo con transparencia para el sombreado
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 2,
                tension: 0.3 // Suaviza las curvas de la línea
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false, // Asegura que el gráfico se adapte al contenedor
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                zoom: {
                    pan: {
                        enabled: true,
                        mode: 'xy'
                    },
                    zoom: {
                        wheel: {
                            enabled: true
                        },
                        pinch: {
                            enabled: true
                        },
                        mode: 'xy'
                    }
                }
            }
        }
    });
</script>


<?php require 'includes/footer_end.php'
?>