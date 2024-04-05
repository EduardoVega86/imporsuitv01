<?php
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../../login.php");
    exit;
}
/* Connect To Database */
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
//include 'is_logged.php'; 
$session_id = session_id();
//echo $session_id; 
$pais = get_row('perfil', 'pais', 'id_perfil', 1);

$tienda = $_GET['id'];

if ($tienda == "local") {
    $parametro = "tienda IS NULL OR tienda = '' OR tienda = 'enviado'";
} else {
    $parametro = "tienda = '$tienda'";
}

get_cadena($user_id);
$modulo = "Pedidos";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$title = "Ventas";
$nombre_usuario = get_row('users', 'usuario_users', 'id_users', $user_id);
?>

<?php require 'includes/header_start.php'; ?>

<?php require 'includes/header_end.php'; ?>

<style>
    .image-bn {
        filter: grayscale(100%);
        transition: filter 0.3s ease;
        /* Animación suave */
    }

    .image-bn:hover {
        filter: grayscale(0%);
    }

    .formulario {
        border-radius: 25px;
        /* O un valor alto para garantizar bordes completamente redondeados */
    }
</style>
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
                        <div class="portlet">
                            <div class="portlet-heading" style="background-color: #171931;">
                                <h3 class="portlet-title">
                                    Nueva Cotización
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
                                <div class="portlet-body">
                                    <?php
                                    include "../modal/buscar_productos_ventas.php";
                                    include "../modal/registro_cliente.php";
                                    include "../modal/registro_producto.php";
                                    ?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card-box">

                                                <div class="widget-chart">
                                                    <div id="resultados_ajaxf" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->
                                                    <form class="form-horizontal" role="form" id="barcode_form">
                                                        <div class="form-group align-items-md-baseline row">
                                                            <label for="barcode_qty" class="col-md-1 control-label">Cant:</label>
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control formulario" id="barcode_qty" value="1" autocomplete="off">
                                                                <input type="hidden" id="parametro" name="parametro" value="<?php echo $parametro; ?>">
                                                            </div>

                                                            <label for="condiciones" class="control-label">Codigo:</label>
                                                            <div class="col-md-5" align="left">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control formulario" id="barcode" autocomplete="off" tabindex="1" autofocus="true">
                                                                    <span class="input-group-btn">
                                                                        <button type="submit" class="btn btn-default"><span class="fa fa-barcode"></span></button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button" accesskey="a" class="btn btn-primary waves-effect waves-light formulario" data-toggle="modal" data-target="#buscar">
                                                                    <span class="fa fa-search"></span> Buscar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <div class="table-responsive">
                                                        <div id="resultados" class='col-md-12' style="margin-top:10px"></div>


                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-lg-6">
                                            <div class="card-box">
                                                <div class="widget-chart">
                                                    <H5><strong>DATOS DESTINATARIO</strong></H5>
                                                    <form method="post" action="../../../ingresar_pedido_1.php" id="formulario">

                                                        <input type="hidden" id="transp" name="transp">
                                                        <input type="hidden" id="transportadora" name="transportadora">
                                                        <input type="hidden" name="destino_c" id="destino_c">
                                                        <input type="hidden" name="nombre_remitente" id=nombre_remitente>
                                                        <input type="hidden" name="apellido_remitente" id=apellido_remitente>
                                                        <input type="hidden" name="direccion_remitente" id=direccion_remitente>
                                                        <input type="hidden" name="telefono_remitente" id=telefono_remitente>
                                                        <input type="hidden" name="servi_flete" id="servi_flete">
                                                        <input type="hidden" name="servi_seguro" id="servi_seguro">
                                                        <input type="hidden" name="servi_comision" id="servi_comision">
                                                        <input type="hidden" name="servi_impuesto" id="servi_impuesto">
                                                        <input type="hidden" name="servi_otros" id="servi_otros">
                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <span class="help-block">Nombre Destinatario </span>

                                                                <input type="text" class="datos form-control formulario" id="nombred" name="nombre" placeholder="Nombre y Apellido *" required>
                                                                <input type="hidden" class="form-control" id="session" name="session" value="<?php echo $session_id; ?>">
                                                                <input type="hidden" class="form-control" id="cliente" name="cliente" value="1">
                                                            </div>

                                                            <div class="col-md-4">
                                                                <span class="help-block">Cedula </span>
                                                                <input type="text" class="datos form-control formulario" id="cedula" name="cedula" placeholder="cedula">

                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="help-block">Teléfono </span>
                                                                <input id="telefonod" name="telefono" class="form-control formulario" placeholder="telefono" value="">

                                                            </div>

                                                        </div>
                                                        <div class="row">



                                                            <div class="col-md-4">
                                                                <span class="help-block">Ciudad </span>
                                                                <div id="div_ciudad">
                                                                    <select class="datos form-control formulario" onclick="" id="ciudad_entrega" name="ciudad_entrega" onchange="seleccionarProvincia()" required>
                                                                        <option value="">Ciudad *</option>
                                                                        <?php
                                                                        $sql2 = "select * from ciudad_laar ";
                                                                        //echo $sql2;
                                                                        $query2 = mysqli_query($conexion, $sql2);

                                                                        $rowcount = mysqli_num_rows($query2);
                                                                        //echo $rowcount;
                                                                        $i = 1;
                                                                        while ($row2 = mysqli_fetch_array($query2)) {
                                                                            $id_ciudad = $row2['id_ciudad'];
                                                                            $nombre = $row2['nombre'];
                                                                            $cod_ciudad = $row2['codigo'];
                                                                            $valor_seleccionado = $ciudaddestino;
                                                                            $selected = ($valor_seleccionado == $cod_ciudad) ? 'selected' : '';

                                                                            // Imprimir la opción con la marca de "selected" si es el valor almacenado
                                                                            echo '<option value="' . $cod_ciudad . '" ' . $selected . '>' . $nombre . '</option>';
                                                                        ?>

                                                                        <?php } ?>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="help-block">Provincia </span>
                                                                <select class="datos form-control formulario" id="provinica" name="provinica" required>
                                                                    <option value="">Provincia *</option>
                                                                    <?php
                                                                    $sql2 = "select * from provincia_laar where id_pais=$pais";
                                                                    $query2 = mysqli_query($conexion, $sql2);

                                                                    while ($row2 = mysqli_fetch_array($query2)) {
                                                                        $id_prov = $row2['id_prov'];
                                                                        $provincia = $row2['provincia'];
                                                                        $cod_provincia = $row2['codigo_provincia'];

                                                                        // Obtener el valor almacenado en la tabla orgien_laar
                                                                        $valor_seleccionado = $provinciadestino;

                                                                        // Verificar si el valor actual coincide con el almacenado en la tabla
                                                                        $selected = ($valor_seleccionado == $cod_provincia) ? 'selected' : '';

                                                                        // Imprimir la opción con la marca de "selected" si es el valor almacenado
                                                                        echo '<option value="' . $cod_provincia . '" ' . $selected . '>' . $provincia . '</option>';
                                                                    }
                                                                    ?>
                                                                </select>



                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="help-block">Sector </span>
                                                                <input type="text" class="datos form-control rounded formulario" id="sector" name="sector" placeholder="Sector">
                                                            </div>
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <span class="help-block">Calle principal </span>
                                                                <input type="text" class="datos form-control formulario" id="calle_principal" name="calle_principal" placeholder="Calle Principal *" required>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="help-block">Calle secundaria </span>
                                                                <input type="text" class="datos form-control formulario" id="calle_secundaria" name="calle_secundaria" placeholder="Calle Secundaria *" required>

                                                            </div>

                                                            <div class="col-md-4">
                                                                <span class="help-block">Numero de casa </span>
                                                                <input id="numerocasa" name="numerocasa" class="form-control formulario" value="">

                                                            </div>
                                                            <input type="hidden" id="costo_envio" name="costo_envio">

                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <span class="help-block">Referencia </span>
                                                                <input type="text" class="datos form-control formulario" id="referencia" name="referencia" placeholder="Referencia *" required>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <span class="help-block">Observaciones para la entrega </span>
                                                                <input type="text" class="datos form-control formulario" id="observacion" name="observacion" placeholder="Referencias Adicionales (Opcional)">
                                                            </div>
                                                        </div>







                                                        <div style="background-color: #F6F6F6" class="card-box mt-3">
                                                            <div class="widget-chart">
                                                                <div class="text-center mb-4">
                                                                    <span class="fs-4 font-bold">
                                                                        Generar Guías
                                                                    </span>
                                                                </div>
                                                                <div class="d-flex justify-content-center">
                                                                    <!-- Primera Columna -->
                                                                    <div class="col-md-2">

                                                                        <div id="card3" onclick="seleccionar_transportadora(3)" class="card formulario p-1">

                                                                            <img style="width: 100%;" id="tr3" src="../../img_sistema/servi.png" class="card-img-top  formulario image-bn interactive-image" alt="Selecciona Laarcourrier">
                                                                            <div class="card-body" style="text-align: center;">
                                                                                <strong id="precio_servientrega">---</strong>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Segunda Columna -->
                                                                    <div class="col-md-2">
                                                                        <div id="card1" class="card formulario p-1">

                                                                            <img style="width: 100%;" id="tr1" onclick="seleccionar_transportadora(1)" src="../../img_sistema/laar.png" class="card-img-top image-bn interactive-image formulario" alt="Selecciona Servientrega">
                                                                            <div class="card-body" style="text-align: center;">

                                                                                <strong id="precio_laar">---</strong>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Tercera Columna -->
                                                                    <div class="col-md-2">
                                                                        <div id="card2" class="card formulario p-1">
                                                                            <img style="width: 100%;" id="tr2" onclick="seleccionar_transportadora(2)" src="../../img_sistema/speed.png" class="card-img-top image-bn interactive-image formulario" alt="Selecciona Guia Local">
                                                                            <div class="card-body" style="text-align: center;">

                                                                                <strong id="aplica">NO APLICA</strong>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div id="card4" class="card formulario p-1 ">
                                                                            <img style="width: 50%;" id="tr2" onclick="seleccionar_transportadora(4)" src="../../img_sistema/gintracom.png" class="card-img-top image-bn interactive-image formulario" alt="Selecciona Guia Local">
                                                                            <div class="card-body" style="text-align: center;">

                                                                                <strong>Proximamente</strong>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-center flex-nowrap mt-4">
                                                                <div class="col-md-3">
                                                                    <span class="help-block">Recaudo </span>
                                                                    <select onchange="seleccionarProvincia()" id="cod" name="cod" class="form-control">
                                                                        <option value="0">Seleccionar</option>
                                                                        <option value="1" selected>Con Recuado</option>
                                                                        <option value="2">Sin Recaudo </option>
                                                                    </select>


                                                                    <input type="hidden" id="id_pedido_cot_" name="id_pedido_cot">
                                                                </div>

                                                                <div class="col-md-3">

                                                                    <div class="form-group">
                                                                        <label for="asegurar_producto">
                                                                            <input class="formulario" style="width: 20px; height: 20px; margin-top: 25px" type="checkbox" id="asegurar_producto" name="asegurar_producto" value="1">
                                                                            Deseo asegurar la mercadería
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <span class="help-block">Valor a asegurar </span>
                                                                    <input id="valorasegurado" name="valorasegurado" class="form-control" value="" placeholder="Valor a aegurar">

                                                                </div>





                                                            </div>

                                                            <div class="d-flex justify-content-center flex-wrap gap-3">
                                                                <?php
                                                                $pais = get_row('perfil', 'pais', 'id_perfil', 1);
                                                                if ($pais == 1) {
                                                                ?>

                                                                    <div class="">
                                                                        </br>
                                                                        <button type="submit" style="width:100%; height: 40px; font-size: 20px" role="button" class="btn btn-success "><span class="texto_boton"> Completa tu compra</span></button>
                                                                    </div>

                                                                    <div class="">
                                                                        </br>

                                                                        <button style="cursor: pointer;" id="generar_guia_btn" type="button" onclick="generar_guia()" class="btn btn-danger" disabled>Generar Guía</button>

                                                                    </div>
                                                                    <div class="">
                                                                        </br>
                                                                        <button style="cursor: pointer;" type="button" onclick="calcular_guia()" class="btn btn-primary">Facturar</button>
                                                                    </div>
                                                            </div>

                                                        <?php
                                                                }
                                                        ?>
                                                        <div class="col-md-6">
                                                            </br>


                                                        </div>
                                                        </div>
                                                </div>

                                                </form>

                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <!-- end row -->


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
<script type="text/javascript" src="../../js/cotizacion_nueva_1.js"></script>
<!-- ============================================================== -->
<!-- Codigos Para el Auto complete de Clientes -->
<script>
    $(document).ready(function() {
        $("#provinica").select2({
            placeholder: "Selecciona una opción",
            allowClear: true,
            // Puedes añadir más opciones de configuración aquí
        });


    });

    $(document).ready(function() {
        $("#ciudad_entrega").select2({
            placeholder: "Selecciona una opción",
            allowClear: true,
            // Puedes añadir más opciones de configuración aquí
        });


    });

    $(function() {
        $("#nombre_cliente").autocomplete({
            source: "../ajax/autocomplete/clientes.php",
            minLength: 2,
            select: function(event, ui) {
                event.preventDefault();
                $('#id_cliente').val(ui.item.id_cliente);
                $('#nombre_cliente').val(ui.item.nombre_cliente);
                $('#tel1').val(ui.item.fiscal_cliente);
                $('#em').val(ui.item.email_cliente);
                $.Notification.notify('success', 'bottom right', 'EXITO!', 'CLIENTE AGREGADO CORRECTAMENTE')
            }
        });
    });

    $("#nombre_cliente").on("keydown", function(event) {
        if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
            $("#id_cliente").val("");
            $("#tel1").val("");
            $("#em").val("");
        }
        if (event.keyCode == $.ui.keyCode.DELETE) {
            $("#nombre_cliente").val("");
            $("#id_cliente").val("");
            $("#tel1").val("");
            $("#em").val("");
        }
    });
</script>
<!-- FIN -->
<script>
    var sleepSetTimeout_ctrl;

    function sleep(ms) {
        clearInterval(sleepSetTimeout_ctrl);
        return new Promise(resolve => sleepSetTimeout_ctrl = setTimeout(resolve, ms));
    }

    function generar_guia() {
        alert($("#cantidad_total").val());
        let transportadora = $("#transp").val();
        if (transportadora == "") {
            $.Notification.notify('error', 'bottom right', 'ERROR!', 'Debes seleccionar una transportadora')

        }
        if (transportadora === "1") {
            //obtienne el formulario
            var formulario = document.getElementById('formulario');
            //crea un objeto FormData
            if (document.querySelector("#valorasegurado").value === "") {
                document.querySelector("#valorasegurado").value = 0;
            }

            var data = new FormData(formulario);
            data.append("nombre_destino", document.getElementById('nombred').value);
            data.append("celular", document.getElementById('telefonod').value);
            data.append("direccion", document.getElementById('calle_principal').value + ' ' + document.getElementById('calle_secundaria').value);
            data.append("valor_total", Math.round(document.getElementById('valor_total_').value));
            data.append("cantidad_total", document.getElementById('cantidad_total').value);
            data.append("costo_total", document.getElementById('costo_total').value);
            data.append("ciudad", document.getElementById('ciudad_entrega').value);
            data.append("productos_guia", document.getElementById('productos_guia').value);
            data.append("identificacion", document.getElementById('cedula').value);
            data.append("seguro", document.getElementById('asegurar_producto').value);



            // generar el pedido
            $.ajax({
                url: "../../../ingresar_pedido_1.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    let [guia, precio] = response.split(',');
                    $('#guia').val(guia);
                    $('#precio').val(precio);
                    $('#modal_vuelto').modal('show');
                }
            });




            $.ajax({
                url: '../ajax/calcular_guia.php',
                type: 'post',
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    //alert(response)

                    $('#resultados').html(response);
                    $('#generar_guia_btn').prop('disabled', false);
                } // /success function

            });
            $.ajax({
                url: "../ajax/ultimo_pedido.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#id_pedido_cot_').val(response);
                    data.set('id_pedido_cot', response);
                    $.ajax({
                        url: "../ajax/enviar_laar.php",
                        type: "POST",
                        data: data,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            console.log(response);
                            let [guia, precio] = response.split(',');
                            $('#guia').val(guia);
                            $('#precio').val(precio);
                            $('#modal_vuelto').modal('show');
                            //window.location.href = `./editar_cotizacion.php?id_factura=` + $('#id_pedido_cot_').val();
                        }
                    });
                }
            });


        }
        if (transportadora === "2") {

            //obtienne el formulario
            var formulario = document.getElementById('formulario');
            //crea un objeto FormData
            if (document.querySelector("#valorasegurado").value === "") {
                document.querySelector("#valorasegurado").value = 0;
            }

            var data = new FormData(formulario);
            data.append("nombre_destino", document.getElementById('nombred').value);
            data.append("celular", document.getElementById('telefonod').value);
            data.append("direccion", document.getElementById('calle_principal').value + ' ' + document.getElementById('calle_secundaria').value);
            data.append("valor_total", Math.round(document.getElementById('valor_total_').value));
            data.append("cantidad_total", document.getElementById('cantidad_total').value);
            data.append("costo_total", document.getElementById('costo_total').value);
            data.append("ciudad", document.getElementById('ciudad_entrega').value);
            data.append("productos_guia", document.getElementById('productos_guia').value);
            data.append("identificacion", document.getElementById('cedula').value);
            data.append("seguro", document.getElementById('asegurar_producto').value);



            // generar el pedido
            $.ajax({
                url: "../../../ingresar_pedido_1.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    let [guia, precio] = response.split(',');
                    $('#guia').val(guia);
                    $('#precio').val(precio);
                    $('#modal_vuelto').modal('show');
                }
            });

            $.ajax({
                url: '../ajax/calcular_guia.php',
                type: 'post',
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    //alert(response)

                    $('#resultados').html(response);
                    $('#generar_guia_btn').prop('disabled', false);
                } // /success function

            });
            $.ajax({
                url: "../ajax/ultimo_pedido.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#id_pedido_cot_').val(response);
                    data.set('id_pedido_cot', response);
                    $.ajax({
                        url: "../ajax/enviar_guia_local.php",
                        type: "POST",
                        data: data,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            console.log(response);
                            let [guia, precio] = response.split(',');
                            $('#guia').val(guia);
                            $('#precio').val(precio);
                            $('#modal_vuelto').modal('show');
                            window.location.href = `./editar_cotizacion.php?id_factura=` + $('#id_pedido_cot_').val();
                        }
                    });
                }
            });

        }
        if (transportadora === "3") {
            //obtienne el formulario
            var formulario = document.getElementById('formulario');
            //crea un objeto FormData
            if (document.querySelector("#valorasegurado").value === "") {
                document.querySelector("#valorasegurado").value = 0;
            }

            var data = new FormData(formulario);
            data.append("nombre_destino", document.getElementById('nombred').value);
            data.append("celular", document.getElementById('telefonod').value);
            data.append("direccion", document.getElementById('calle_principal').value + ' ' + document.getElementById('calle_secundaria').value);
            data.append("valor_total", Math.round(document.getElementById('valor_total_').value));
            data.append("cantidad_total", document.getElementById('cantidad_total').value);
            data.append("costo_total", document.getElementById('costo_total').value);
            data.append("ciudad", document.getElementById('ciudad_entrega').value);
            data.append("productos_guia", document.getElementById('productos_guia').value);
            data.append("identificacion", document.getElementById('cedula').value);
            data.append("seguro", document.getElementById('asegurar_producto').value);
            data.append("contenido", document.getElementById('producto_name').textContent) + "x" + document.getElementById('producto_qty').textContent;



            // generar el pedido
            $.ajax({
                url: "../../../ingresar_pedido_1.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    let [guia, precio] = response.split(',');
                    $('#guia').val(guia);
                    $('#precio').val(precio);
                    $('#modal_vuelto').modal('show');
                }
            });




            $.ajax({
                url: '../ajax/calcular_guia.php',
                type: 'post',
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    //alert(response)

                    $('#resultados').html(response);
                    $('#generar_guia_btn').prop('disabled', false);
                } // /success function

            });
            $.ajax({
                url: "../ajax/ultimo_pedido.php",
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#id_pedido_cot_').val(response);
                    data.set('id_pedido_cot', response);
                    let ciudad_texto = $('#ciudad_entrega option:selected').text();
                    let destino_texto = $('#destino_c').val();
                    data.append('ciudad_texto', ciudad_texto);
                    data.append('destino_texto', destino_texto);
                    $.ajax({
                        url: "../ajax/datos_servi.php",
                        type: "POST",
                        data: data,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            let datos_servi = JSON.parse(response);
                            let [codigo, codigo_origen] = [datos_servi.codigo, datos_servi.codigo_origen];
                            data.append('codigo', codigo);
                            data.append('codigo_origen', codigo_origen);

                            let esRecaudo = $('#cod').val();

                            if (esRecaudo == 1) {


                                $.ajax({
                                    url: "../../../ajax/servientrega/generar_guia_servientrega_r.php",
                                    type: "POST",
                                    data: data,
                                    contentType: false,
                                    processData: false,
                                    success: function(response) {
                                        let data_se = JSON.parse(response);
                                        let id_servi = data_se["id"];
                                        data.append('id_servi', id_servi);

                                        $.ajax({
                                            url: "../ajax/enviar_servi.php",
                                            type: "POST",
                                            data: data,
                                            contentType: false,
                                            processData: false,
                                            success: function(response) {
                                                console.log(response);
                                                let [guia, precio] = response.split(',');
                                                $('#guia').val(guia);
                                                $('#precio').val(precio);
                                                $('#modal_vuelto').modal('show');
                                                // window.location.href = `./editar_cotizacion.php?id_factura=` + $('#id_pedido_cot_').val();
                                            }
                                        })
                                    }
                                })
                            } else if (esRecaudo == 2) {

                                $.ajax({
                                    url: "../../../ajax/servientrega/generar_guia_servientrega.php",
                                    type: "POST",
                                    data: data,
                                    contentType: false,
                                    processData: false,
                                    success: function(response) {
                                        let data_se = JSON.parse(response);
                                        let id_servi = data_se["id"];
                                        data.append('id_servi', id_servi);

                                        $.ajax({
                                            url: "../ajax/enviar_servi.php",
                                            type: "POST",
                                            data: data,
                                            contentType: false,
                                            processData: false,
                                            success: function(response) {
                                                console.log(response);
                                                let [guia, precio] = response.split(',');
                                                $('#guia').val(guia);
                                                $('#precio').val(precio);
                                                $('#modal_vuelto').modal('show');
                                                window.location.href = `./editar_cotizacion.php?id_factura=` + $('#id_pedido_cot_').val();
                                            }
                                        })
                                    }
                                })
                                //window.location.href = `./editar_cotizacion.php?id_factura=` + $('#id_pedido_cot_').val();
                            }
                        }
                    });
                }
            });

        }
    }


    if (window.location.search != null) {
        let search_tienda = window.location.search.split("=")[1]
        fetch(`../ajax/verificar_fullfill.php?tienda=${search_tienda}`)
            .then(response => response.text())
            .then(html => {
                if (html == 1) {
                    document.getElementById("aplica").innerHTML = "---"
                }
            })
    }

    document



    // print order function
    function seleccionar_transportadora(id) {
        // Elimina el color y los bordes de todas las tarjetas e imágenes
        $('.card').css('border', 'none');
        $('.interactive-image').css('filter', 'grayscale(100%)');

        // Añade el borde a la tarjeta seleccionada y el color a la imagen
        $('#card' + id).css('border', '2px solid #154289'); // Puedes cambiar el color del borde aquí
        $('#tr' + id).css('filter', 'none');
        $('#transp').val(id);
        $('#transportadora').val(id);
        console.log(id);
        if (id === 1) {
            let costo_envio_sin_signo = $('#precio_laar').text();
            costo_envio_sin_signo = costo_envio_sin_signo.replace('$', '');
            $("#costo_envio").val(costo_envio_sin_signo);
        } else if (id === 3) {
            $("#costo_envio").val($("#precio_servientrega").text());
        }

    }

    function printFactura(id_factura) {
        $('#modal_vuelto').modal('hide');
        if (id_factura) {
            $.ajax({
                url: '../pdf/documentos/imprimir_cotizacion.php',
                type: 'post',
                data: {
                    id_factura: id_factura
                },
                dataType: 'text',
                success: function(response) {
                    var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
                    mywindow.document.write('<html><head><title>Facturación</title>');
                    mywindow.document.write('</head><body>');
                    mywindow.document.write(response);
                    mywindow.document.write('</body></html>');
                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10
                    mywindow.print();
                    mywindow.close();
                } // /success function

            }); // /ajax function to fetch the printable order
        } // /if orderId
    } // /print order function
</script>
<script>
    function obtener_caja(user_id) {
        $(".outer_div3").load("../modal/carga_caja.php?user_id=" + user_id); //carga desde el ajax
    }
</script>
<script>
    function showDiv(select) {
        if (select.value == 4) {
            $("#resultados3").load("../ajax/carga_prima.php");
        } else {
            $("#resultados3").load("../ajax/carga_resibido.php");
        }
    }

    function cargar_provincia_pedido() {

        var id_provincia = $('#provinica').val();
        console.log(id_provincia)
        //alert($('#provinica').val())
        //var data = new FormData(formulario);

        $.ajax({
            url: "../../../ajax/cargar_ciudad_pedido.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: {
                provinica: id_provincia,

            }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            dataType: 'text', // To send DOMDocument or non processed data file it is set to false
            success: function(data) // A function to be called if request succeeds
            {


                $('#div_ciudad').html(data);

                actualizarSelect();
            }
        });



    }

    function actualizarSelect() {
        //alert()
        $('#ciudad_entrega').select2('destroy');

        // Luego actualiza el contenido del select aquí
        // Puedes hacer una llamada AJAX y en el success actualizar el contenido y luego reinicializar
        // ...

        // Después de actualizar el contenido, reinicializa Select2
        $('#ciudad_entrega').select2({
            placeholder: "Selecciona una opción",
            allowClear: true
            // Puedes añadir más opciones de configuración aquí
        });
    }
</script>

<script>
    function seleccionarProvincia() {
        var id_provincia = $('#ciudad_entrega').val();
        let recaudo = $('#cod').val();
        calcular_servi(id_provincia, recaudo);


        $.ajax({
            url: "../ajax/cargar_provincia_pedido.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: {
                ciudad: id_provincia,

            }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            dataType: 'text', // To send DOMDocument or non processed data file it is set to false
            success: function(data) // A function to be called if request succeeds
            {
                $('#provinica').val(data).trigger('change');
                $('#provinica option[value=' + data + ']').attr({
                    selected: true
                });

                //$('#provinica').attr('disabled', 'disabled');
                let precio_total = $('#precio_total').val();

                calcular_guia(recaudo);
                //obtener el texto de los selects}

            }
        }) // /success function

    }

    $("#ciudad_entrega").select2({
        placeholder: "Selecciona una opción",
        allowClear: true,
        // Puedes añadir más opciones de configuración aquí
    });

    function calcular_servi(id_provincia, recaudo) {
        let ciudadOrigen = ""
        let tienda = window.location.search.split("=")[1];
        $.ajax({
            url: "../ajax/obtener_dato_envio_servi.php",
            type: "POST",
            data: {
                tienda: tienda,
                ciudad: id_provincia,
            },
            success: function(data) {
                let datos_envio = JSON.parse(data);

                ciudadOrigen = datos_envio["ciudad"];
                $('#nombre_remitente').val(datos_envio["nombre_remitente"]);
                $('#direccion_remitente').val(datos_envio["direccion_remitente"]);
                $('#telefono_remitente').val(datos_envio["telefono_remitente"]);
                $("#destino_c").val(ciudadOrigen);
                let ciudadDestino = ""
                let ciudad_or = $('#ciudad_entrega option:selected').text();
                let provincia_or = $('#provinica option:selected').text();
                $.ajax({
                    url: "../../../ajax/servientrega/cotizador3.php",
                    type: "POST",
                    data: {
                        ciudad_origen: ciudadOrigen,
                        ciudad_destino: ciudad_or,
                        provincia_destino: provincia_or,
                        precio_total: $('#valor_total_').val(),

                    },
                    success: function(data) {
                        let parser = new DOMParser();
                        let xmlDoc = parser.parseFromString(data, "text/xml");

                        // Extraer el contenido de <Result>
                        let resultString = xmlDoc.getElementsByTagName("Result")[0].childNodes[0].nodeValue;

                        // Convertir el contenido de Result (que es un string de XML) a un objeto que se pueda manipular
                        let resultDoc = parser.parseFromString(resultString, "text/xml");

                        // Obtener el valor de <flete>
                        function getNumericValueFromTag(tagName) {
                            let tag = resultDoc.getElementsByTagName(tagName)[0];
                            if (tag && tag.childNodes.length > 0) {
                                // Convertir el valor del nodo a número y retornarlo
                                return parseFloat(tag.childNodes[0].nodeValue);
                            } else {
                                // Si el elemento no se encuentra o no tiene un valor, retorna 0
                                return 0;
                            }
                        }

                        // Extraer los valores numéricos de cada elemento relevante
                        let flete = getNumericValueFromTag("flete");
                        let seguro = getNumericValueFromTag("seguro");
                        let valorComision = getNumericValueFromTag("valor_comision");
                        let otros = getNumericValueFromTag("otros");
                        let impuesto = getNumericValueFromTag("impuesto");

                        // Sumar todos los valores para obtener el total
                        $('#servi_impuesto').val(impuesto);
                        $('#servi_otros').val(otros);
                        $('#servi_seguro').val(seguro);
                        $('#servi_comision').val(valorComision);
                        $('#servi_flete').val(flete);
                    }

                })
                $.ajax({
                    url: "../ajax/obtener_dato_destino_servi.php",
                    type: "POST",
                    data: {
                        ciudad: id_provincia,
                    },
                    success: function(data) {
                        ciudadDestino = JSON.parse(data);
                        let destino = ciudadDestino["nombre"];
                        let origen = ciudadDestino["provincia"]
                        console.log(ciudadOrigen, destino, origen);

                        let precio_total = $('#valor_total_').val();

                        $.ajax({
                            url: "../../../ajax/servientrega/cotizador1.php",
                            type: "POST",
                            data: {
                                ciudad_origen: ciudadOrigen,
                                ciudad_destino: destino,
                                provincia_destino: origen,
                                precio_total: precio_total,
                            },
                            success: function(data) {
                                let datos = JSON.parse(data);
                                if (datos["trayecto"] !== "x") {
                                    $.ajax({
                                        url: "../../../ajax/servientrega/cotizador2.php",
                                        type: "POST",
                                        data: {
                                            trayecto: datos["trayecto"],
                                        },
                                        success: function(data) {
                                            let datos2 = JSON.parse(data);
                                            let precio = parseFloat(datos2["precio"]);
                                            let total_servi = 0
                                            if (recaudo == 1) {
                                                let valor_total_ = parseFloat($('#valor_total_').val());
                                                total_servi = precio + (valor_total_ * 0.03);
                                            } else {
                                                total_servi = precio;
                                            }

                                            $('#precio_servientrega').text(`$${parseFloat(total_servi).toFixed(2)}`);

                                        }
                                    })
                                }

                            }

                        })
                    }
                })
            }
        })
    }

    function calcular_guia(recaudo) {

        let precio_total = $('#valor_total_').val();
        let provinica = $('#provinica').val();
        let ciudad_entrega = $('#ciudad_entrega').val();
        fetch(`../ajax/calcular_guia_new.php?precio_total=${precio_total}&provincia=${provinica}&ciudad_entrega=${ciudad_entrega}&recaudo=${recaudo}`)
            .then(response => response.json())
            .then(html => {
                console.log(html);
                let precio_laar = html["laar"];
                if (html === undefined || html === null) {
                    $('#precio_laar').text(`NO APPLICA`);
                    $('#costo_envio').val(0);
                } else {
                    $('#precio_laar').text(`$${precio_laar}`);
                    let envio_sin_signo = precio_laar.replace('$', '');
                    $('#costo_envio').val(envio_sin_signo);
                }
            })

        $('#generar_guia_btn').removeAttr('disabled');
    }
</script>

<?php require 'includes/footer_end.php'
?>