<?php
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../../login.php");
    exit;
}
$marketplace_url = $_SERVER['HTTP_HOST'];
$marketplace_url = str_replace(["www.", ".com"], "", $marketplace_url);

// Compara en minúsculas para evitar problemas de sensibilidad a mayúsculas y minúsculas
if (strtolower($marketplace_url) !== "marketplace.imporsuit" && strtolower($marketplace_url) !== 'localhost') {
    header("location: ../../login.php");
    exit;
}
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
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$title          = "Wallet";
$wallets         = 1;
$nombre_usuario = get_row('users', 'usuario_users', 'id_users', $user_id);


if (isset($_GET['id_factura'])) {

    $id_factura     = $_GET['id_factura'];
    $query          = mysqli_query($conexion, "SELECT * FROM cabecera_cuenta_cobrar WHERE numero_factura='" . $id_factura . "'");
    $count         = mysqli_num_rows($query);
    if ($count == 1) {
        $rw_factura = mysqli_fetch_array($query);
        $cliente = $rw_factura['cliente'];
        $tienda = $rw_factura['tienda'];
        $estado_factura = $rw_factura['estado_pedido'];
        $total_venta = $rw_factura['total_venta'];
        $costo = $rw_factura['costo'];
        $precio_envio = $rw_factura['precio_envio'];
        $monto_recibir = $rw_factura['monto_recibir'];
        $fecha = $rw_factura['fecha'];

        if ($estado_factura == 1) {
            $text_estado = "INGRESADA";
            $label_class = 'badge-success';
        } else {
            $text_estado = "CREDITO";
            $label_class = 'badge-danger';
        }

        switch ($estado_factura) {

            case 1:
                $text_estado = "Confirmar";
                $label_class = 'badge-success';
                break;
            case 2:
                $text_estado = "Pick y Pack ";
                $label_class = 'badge-info';
                break;
            case 3:
                $text_estado = "Despachado";
                $label_class = 'badge-success';
                break;
            case 4:
                $text_estado = "Zona de entrega ";
                $label_class = 'badge-purple';
                break;
            case 5:
                $text_estado = "Cobrado";
                $label_class = 'badge-warning';
                break;
            case 6:
                $text_estado = "Pagado ";
                $label_class = 'badge-purple';
                break;

            case 7:
                $text_estado = "Liquidado";
                $label_class = 'badge-primary';
                break;
            case 8:
                $text_estado = "Anulado";
                $label_class = 'badge-danger';
                break;
            default:
                echo "Estado no reconocido";
        }
        $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
    } else {
        exit;
    }
} else {
    exit;
}

?>

<?php require 'includes/header_start.php'; ?>

<?php require 'includes/header_end.php'; ?>

<style>
    .stepwizard-step p {
        margin-top: 10px;
    }

    .stepwizard-row {
        display: table-row;
    }

    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }

    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }

    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;

    }

    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
</style>

<div id="wrapper" class="forced enlarged">

    <?php


    require 'includes/menu.php';
    // echo $guia_enviada;

    ?>

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
                                    Editar Wallet
                                </h3>
                                <div class="portlet-widgets">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="bg-primary" class="panel-collapse collapse show">
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col">
                                            <table class="table table-sm table-striped table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">ORDEN</th>
                                                        <th class="text-center">FECHA</th>
                                                        <th class="text-center">CLIENTE</th>
                                                        <th class="text-center">TIENDA</th>
                                                        <th class="text-center">ESTADO</th>
                                                        <th class="text-center">TOTAL</th>
                                                        <th class="text-center">COSTO</th>
                                                        <th class="text-center">ENVIO</th>
                                                        <th class="text-center">MONTO RECIBIR</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><label class="badge badge-purple"> <?php echo $id_factura; ?></label></td>
                                                        <td class="text-center"><?php echo $fecha; ?></td>
                                                        <td class="text-center"><?php echo $cliente; ?></td>
                                                        <td class="text-center"><?php echo $tienda; ?></td>

                                                        <td class="text-center"><span class="badge <?php echo $label_class; ?>"><?php echo $text_estado; ?></span></td>
                                                        <td class="text-center"><?php echo $simbolo_moneda . $total_venta; ?></td>
                                                        <td class="text-center"><?php echo $simbolo_moneda . $costo; ?></td>
                                                        <td class="text-center"><?php echo $simbolo_moneda . $precio_envio; ?></td>
                                                        <td class="text-center"><?php echo $simbolo_moneda . $monto_recibir; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col">

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
<script type="text/javascript" src="../../js/editar_cotizacion.js"></script>
<!-- ============================================================== -->
<!-- Codigos Para el Auto complete de Clientes -->
<script>
    $(function() {
        $("#nombre_cliente").autocomplete({
            source: "../ajax/autocomplete/clientes.php",
            minLength: 2,
            select: function(event, ui) {
                event.preventDefault();
                $('#id_cliente').val(ui.item.id_cliente);
                $('#nombre_cliente').val(ui.item.nombre_cliente);
                $('#rnc').val(ui.item.fiscal_cliente);
                $.Notification.notify('custom', 'bottom right', 'EXITO!', 'CLIENTE AGREGADO CORRECTAMENTE')
            }
        });
    });

    $("#nombre_cliente").on("keydown", function(event) {
        if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
            $("#id_cliente").val("");
            $("#rnc").val("");
            $("#resultados4").load("../ajax/tipo_doc.php");
        }
        if (event.keyCode == $.ui.keyCode.DELETE) {
            $("#nombre_cliente").val("");
            $("#id_cliente").val("");
            $("#rnc").val("");
        }
    });
</script>
<!-- FIN -->
<script>
    // print order function

    function cargar_provincia_pedido() {

        var id_provincia = $('#provinica').val();
        //alert($('#provinica').val())
        //var data = new FormData(formulario);

        $.ajax({
            url: "../ajax/cargar_ciudad_pedido.php", // Url to which the request is send
            type: "POST", // Type of request to be send, called as method
            data: {
                provinica: id_provincia,


            }, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            dataType: 'text', // To send DOMDocument or non processed data file it is set to false
            success: function(data) // A function to be called if request succeeds
            {



                $('#div_ciudad').html(data);


            }
        });

    }





    function generar_guia(id_factura) {
        nombre_destino = $('#nombredestino').val();
        identificacion = $('#identificacion').val();
        ciudad = $('#ciudad_entrega').val();;
        //alert(ciudad);
        direccion_destino = $('#direccion_destino').val(); //CIERRA LA MODAL
        //alert(direccion_destino);
        referencia = $('#referencia').val(); //CIERRA LA MODAL
        telefono = $('#telefono').val(); //CIERRA LA MODAL
        celular = $('#celular').val(); //CIERRA LA MODAL
        observacion = $('#observacion').val(); //CIERRA LA MODAL
        cod = $('#cod').val(); //CIERRA LA MODAL
        seguro = $('#seguro').val(); //CIERRA LA MODAL
        productos_guia = $('#productos_guia').val();
        cantidad_total = $('#cantidad_total').val();
        valor_total = $('#valor_total_').val();
        costo_total = $('#costo_total').val();

        numerocasa = $('#numerocasa').val();
        valor_envio = $('#valor_total_').val();
        valorasegurado = $('#valorasegurado').val();

        id_pedido_cot = $('#id_pedido_cot').val();
        //alert(id_pedido_cot);




        id_factura = 1;
        if (id_factura = 1) {
            $.ajax({
                url: '../ajax/enviar_laar.php',
                type: 'post',
                data: {
                    nombre_destino: nombre_destino,
                    ciudad: ciudad,
                    direccion: direccion_destino,
                    referencia: referencia,
                    telefono: telefono,
                    celular: celular,
                    observacion: observacion,
                    cod: cod,
                    seguro: seguro,
                    productos_guia: productos_guia,
                    cantidad_total: cantidad_total,
                    valor_total: valor_total,
                    numerocasa: numerocasa,
                    id_pedido_cot: id_pedido_cot,
                    identificacion: identificacion,
                    costo_total: costo_total,
                    valorasegurado: valorasegurado,

                },
                dataType: 'text',
                success: function(response) {

                    if (response == 'ok') {
                        Swal.fire({
                            title: "¡Generación de guía exitosa!",
                            icon: "success",
                            confirmButtonText: "¡Aceptar!",
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        //  let objetoJSON = JSON.parse(response);
                        Swal.fire({
                            title: "Oops...",
                            text: response,
                            icon: "error",
                            confirmButtonText: "¡Aceptar!",
                        }).then(() => {
                            window.location.reload();
                        });

                    }

                } // /success function

            }); // /ajax function to fetch the printable order
        } // /if orderId
    }

    function anular_guia(guia, id) {

        id_factura = 1;
        if (id_factura = 1) {
            $.ajax({
                url: '../ajax/eliminar_guia.php',
                type: 'post',
                data: {
                    guia: guia,
                    id: id,

                },
                dataType: 'text',
                success: function(response) {

                    if (response == 'ok') {
                        location.reload();
                    } else {
                        alert(response)
                    }

                } // /success function

            }); // /ajax function to fetch the printable order
        } // /if orderId
    }

    function printOrder(id_factura) {
        $('#modal_vuelto').modal('hide'); //CIERRA LA MODAL
        if (id_factura) {
            $.ajax({
                url: '../pdf/documentos/imprimir_venta.php',
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
    // print order function
    function printFactura(id_factura) {
        $('#modal_vuelto').modal('hide');
        if (id_factura) {
            $.ajax({
                url: '../pdf/documentos/imprimir_factura_venta.php',
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

    function showDiv(select) {
        if (select.value == 4) {
            $("#resultados3").load("../ajax/carga_prima.php");
        } else {
            $("#resultados3").load("../ajax/carga_resibido.php");
        }
    }

    function comprobar(select) {
        var rnc = $("#rnc").val();
        id_comp == $("#id_comp").val();
        //alert(id_comp)
        if (select.value == 1 && rnc == '') {
            $.Notification.notify('warning', 'bottom center', 'NOTIFICACIÓN', 'AL CLIENTE SELECCIONADO NO SE LE PUEDE IMPRIR LA FACTURA, NO TIENE RNC/DEDULA REGISTRADO')
            $("#resultados4").load("../ajax/tipo_doc.php");
        } else {
            //$("#resultados3").load("../ajax/carga_resibido.php");
        }
    }

    function getval(sel) {
        $.Notification.notify('success', 'bottom center', 'NOTIFICACIÓN', 'CAMBIO DE COMPROBANTE')
        $("#outer_comprobante").load("../ajax/carga_correlativos.php?id_comp=" + sel.value);

    }
    $(document).ready(function() {
        $(".UpperCase").on("keypress", function() {
            $input = $(this);
            setTimeout(function() {
                $input.val($input.val().toUpperCase());
            }, 50);
        })
    })
</script>

<?php require 'includes/footer_end.php'
?>