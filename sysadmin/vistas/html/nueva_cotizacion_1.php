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
        transition: filter 0.3s ease; /* Animación suave */
    }

    .image-bn:hover {
        filter: grayscale(0%);
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
                            <div class="portlet-heading bg-primary">
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
                                                        <div class="form-group row">
                                                            <label for="barcode_qty" class="col-md-1 control-label">Cant:</label>
                                                            <div class="col-md-2">
                                                                <input type="text" class="form-control" id="barcode_qty" value="1" autocomplete="off">
                                                                <input type="hidden" id="parametro" name="parametro" value="<?php echo $parametro; ?>">
                                                            </div>

                                                            <label for="condiciones" class="control-label">Codigo:</label>
                                                            <div class="col-md-5" align="left">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="barcode" autocomplete="off" tabindex="1" autofocus="true">
                                                                    <span class="input-group-btn">
                                                                        <button type="submit" class="btn btn-default"><span class="fa fa-barcode"></span></button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button" accesskey="a" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#buscar">
                                                                    <span class="fa fa-search"></span> Buscar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <div id="resultados" class='col-md-12' style="margin-top:10px"></div><!-- Carga los datos ajax -->

                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-lg-6">
                                            <div class="card-box">
                                                <div class="widget-chart">
                                                    <H5><strong>DATOS DESTINATARIO</strong></H5>
                                                    <form method="post" action="../../../ingresar_pedido.php" id="formulario">


                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <span class="help-block">Nombre Destinatario </span>

                                                                <input type="text" class="datos form-control" id="nombre" name="nombre" placeholder="Nombre y Apellido *" required>
                                                                <input type="hidden" class="form-control" id="session" name="session" value="<?php echo $session_id; ?>">
                                                                <input type="hidden" class="form-control" id="cliente" name="cliente" value="1">
                                                            </div>

                                                            <div class="col-md-4">
                                                                <span class="help-block">Telefono </span>
                                                                <input type="text" class="datos form-control" id="telefono" name="telefono" placeholder="Telefono *" required>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="help-block">Celular </span>
                                                                <input id="celular" name="celular" class="form-control" placeholder="Celular" value="">

                                                            </div>

                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <span class="help-block">Provincia </span>
                                                                <select onchange="cargar_provincia_pedido()" class="datos form-control" id="provinica" name="provinica" required>
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
                                                                <span class="help-block">Ciudad </span>
                                                                <div id="div_ciudad">
                                                                    <select class="datos form-control" onclick="" id="ciudad_entrega" name="ciudad_entrega" required>
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
                                                                <span class="help-block">Sector </span>
                                                                <input type="text" class="datos form-control" id="sector" name="sector" placeholder="Sector">
                                                                </div>
                                                        </div>

                                                        <div class="row">

                                                            <div class="col-md-4">
                                                                <span class="help-block">Calle principal </span>
                                                                <input type="text" class="datos form-control" id="calle_principal" name="calle_principal" placeholder="Calle Principal *" required>

                                                            </div>
                                                            <div class="col-md-4">
                                                                <span class="help-block">Calle secundaria </span>
                                                                <input type="text" class="datos form-control" id="calle_secundaria" name="calle_secundaria" placeholder="Calle Secundaria *" required>

                                                            </div>

<div class="col-md-4">
                                                                <span class="help-block">Numero de casa </span>
                                                                <input id="numerocasa" name="numerocasa" class="form-control" value="">

                                                            </div>

                                                        </div>
                                                       
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <span class="help-block">Referencia </span>
                                                                <input type="text" class="datos form-control" id="referencia" name="referencia" placeholder="Referencia *" required>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <span class="help-block">Observaciones para la entrega </span>
                                                                <input type="text" class="datos form-control" id="observacion" name="observacion" placeholder="Referencias Adicionales (Opcional)">
                                                            </div>
                                                        </div>







                                                        <div style="background-color: #e2e3e5" class="card-box">
                                                            <div class="widget-chart">                                                
                                                                <div class="row">
                                                                    <H5><strong>GENERAR GUÍA</strong></H5>
                                                                    <div class="row">
                                                                        <!-- Primera Columna -->
                                                                        <div class="col-md-2">
                                                                            <div id="card3" onclick="seleccionar_transportadora(3)" class="card">

                                                                                <img style="width: 100%;" id="tr3" src="../../img_sistema/servi.png" class="card-img-top image-bn interactive-image" alt="Selecciona Laarcourrier">
                                                                                <div class="card-body">


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Segunda Columna -->
                                                                        <div class="col-md-2">
                                                                            <div id="card1" class="card">

                                                                                <img style="width: 100%;" id="tr1" onclick="seleccionar_transportadora(1)" src="../../img_sistema/laar.png" class="card-img-top image-bn interactive-image"   alt="Selecciona Servientrega">
                                                                                <div class="card-body">


                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Tercera Columna -->
                                                                        <div class="col-md-2">
                                                                            <div id="card2" class="card">
                                                                                <img style="width: 100%;" id="tr2" onclick="seleccionar_transportadora(2)" src="../../img_sistema/speed.png" class="card-img-top image-bn interactive-image" alt="Selecciona Guia Local">
                                                                                <div class="card-body">


                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <span class="help-block">Recaudo </span>
                                                                        <select onchange="calcular_guia()" id="cod" name="cod" class="form-control">
                                                                            <option value="0">Seleccionar</option>
                                                                            <option value="1" selected>Con Recuado</option>
                                                                            <option value="0">Sin Recaudo </option>
                                                                        </select>



                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <span class="help-block">Seguro </span>
                                                                        <select onchange="calcular_guia()" id="seguro" name="seguro" class="form-control">
                                                                            <option value="">Deseas asegurar la mercadería </option>
                                                                            <option value="1">SI</option>
                                                                            <option value="0">NO </option>
                                                                        </select>
                                                                        <input id="valorasegurado" name="valorasegurado" class="form-control" value="" placeholder="Valor a aegurar">



                                                                    </div>



                                                                </div>

                                                                <div class="row">
                                                                    <?php
                                                                    $pais = get_row('perfil', 'pais', 'id_perfil', 1);
                                                                    if ($pais == 1) {
                                                                        ?>

                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                </br>
                                                                                <button type="submit" style="width:100%; height: 40px; font-size: 20px" class="btn boton"><span class="texto_boton"> Completa tu compra</span></button>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                </br>


                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            </br>

                                                                            <button style="cursor: pointer;" id="generar_guia_btn" type="button" onclick="generar_guia()" class="btn btn-danger" disabled>Generar Guía</button>

                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            </br>
                                                                            <button style="cursor: pointer;" type="button" onclick="calcular_guia()" class="btn btn-primary">Calcular</button>
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
<script type="text/javascript" src="../../js/cotizacion_nueva.js"></script>
<!-- ============================================================== -->
<!-- Codigos Para el Auto complete de Clientes -->
<script>
     $(document).ready(function () {
    $("#provinica").select2({
      placeholder: "Selecciona una opción",
      allowClear: true,
      // Puedes añadir más opciones de configuración aquí
    });
   
    
  });
  
    $(document).ready(function () {
    $("#ciudad_entrega").select2({
      placeholder: "Selecciona una opción",
      allowClear: true,
      // Puedes añadir más opciones de configuración aquí
    });
   
    
  });
  
                                                                        $(function () {
                                                                            $("#nombre_cliente").autocomplete({
                                                                                source: "../ajax/autocomplete/clientes.php",
                                                                                minLength: 2,
                                                                                select: function (event, ui) {
                                                                                    event.preventDefault();
                                                                                    $('#id_cliente').val(ui.item.id_cliente);
                                                                                    $('#nombre_cliente').val(ui.item.nombre_cliente);
                                                                                    $('#tel1').val(ui.item.fiscal_cliente);
                                                                                    $('#em').val(ui.item.email_cliente);
                                                                                    $.Notification.notify('success', 'bottom right', 'EXITO!', 'CLIENTE AGREGADO CORRECTAMENTE')
                                                                                }
                                                                            });
                                                                        });

                                                                        $("#nombre_cliente").on("keydown", function (event) {
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
    // print order function
    function seleccionar_transportadora(id) {
        // Elimina el color y los bordes de todas las tarjetas e imágenes
        $('.card').css('border', 'none');
        $('.interactive-image').css('filter', 'grayscale(100%)');

        // Añade el borde a la tarjeta seleccionada y el color a la imagen
        $('#card' + id).css('border', '2px solid #154289'); // Puedes cambiar el color del borde aquí
        $('#tr' + id).css('filter', 'none');
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
                success: function (response) {
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
        //alert($('#provinica').val())
        //var data = new FormData(formulario);

        $.ajax({
            url: "../../../ajax/cargar_ciudad_pedido.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: {
                provinica: id_provincia,

            }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            dataType: 'text', // To send DOMDocument or non processed data file it is set to false
            success: function (data) // A function to be called if request succeeds
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

<?php require 'includes/footer_end.php'
?>