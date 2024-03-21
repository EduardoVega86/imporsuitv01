<?php
include("../db.php");
include("../php_conexion.php");
include("../funciones.php");
$id_pedido = $_POST['id_factura'];


$sql = "select * from facturas_cot where id_factura=$id_pedido";
$resultado = mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_array($resultado)) {
    $identificacion = get_row('guia_laar', 'identificacionD', 'id_pedido', $id_pedido);

    $nombre_cliente = $row['nombre'];
    $telefono = $row['telefono'];
    $direccion = $row['c_principal'] . ' ' . $row['c_secundaria'];

    $sql_cliente = "select * from clientes where fiscal_cliente='$identificacion'";
    echo $sql_cliente;
    $resultado_cliente = mysqli_query($conexion, $sql_cliente);
    if ($resultado_cliente) {
        $num_rows = mysqli_num_rows($resultado_cliente);
        if ($num_rows > 0) {

            while ($cliente = mysqli_fetch_array($resultado_cliente)) {
                $nombre_cliente = $cliente['nombre_cliente'];
                $telefono_cliente = $cliente['telefono_cliente'];
                $identificacion = $cliente['fiscal_cliente'];
                $id_cliente= $cliente['id_cliente'];
            }
        } else {
            $insertar_cliente_sql = "INSERT INTO `clientes` (`nombre_cliente`, `fiscal_cliente`, `telefono_cliente`, `email_cliente`, `direccion_cliente`, `status_cliente`, `date_added`, `razon_social`, `nombre_contacto`, `telefono_contacto`, `cargo_contacto`, `observaciones`, `dias_credito`, `giro_negocio`, `ciudad`) "
                    . "VALUES ('$nombre_cliente', '$identificacion', '$telefono', '.', '$direccion', '1', '2024-03-20 04:49:22.000000', '.', '.', '.', '.', '.', '1', '.', '.');";
            echo $insertar_cliente_sql;
            $insertar_cliente = mysqli_query($conexion, $insertar_cliente_sql);
            $id_cliente = mysqli_insert_id($conexion);
// La consulta no devolvió resultados para este cliente
        }
    }
}
?>
<div class="card-box">
    <div class="widget-chart">
        <div class="editar_factura" class='col-md-12' style="margin-top:10px"></div>

        <form role="form" id="datos_factura">
            <input id="id_vendedor" name="id_vendedor" type='hidden' value="1">


            <div class="form-group row">
                <label class="col-2 col-form-label"></label>
                <div class="col-12">
                    <div class="input-group">
                        <input type="text" id="nombre_cliente" class="form-control" required value="<?php echo $nombre_cliente; ?>" tabindex="2">
                        <!--span class="input-group-btn">
                                <button type="button" class="btn waves-effect waves-light btn-success" data-toggle="modal" data-target="#nuevoCliente"><li class="fa fa-plus"></li></button>
                        </span-->
                        <input id="id_cliente1" name="id_cliente1" type='hidden' value="<?php echo $id_cliente; ?>">
                    </div>
                </div>
            </div>
            
                       
                        <input type="hidden" class="form-control" autocomplete="off" id="cotizacion"  name="cotizacion" value="<?php echo $id_pedido; ?>" readonly>
                 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fiscal">RNC/Cedula</label>
                        <input type="text" class="form-control" autocomplete="off" id="rnc1" name="rnc1" minlength="10" tabindex="2" maxlength="13" value="<?php echo $identificacion; ?>">
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="id_comp" class="control-label">Comprobante:</label>
                        <select id = "id_comp" class = "form-control" name = "id_comp" required autocomplete="off" onchange="getval(this);">
												<option value="">-- Selecciona --</option>
												<?php

												$query_categoria = mysqli_query($conexion, "select * from comprobantes ");
												while ($rw = mysqli_fetch_array($query_categoria)) {

												?>
													<option value="<?php echo $rw['id_comp']; ?>"><?php echo $rw['nombre_comp']; ?></option>
												<?php
												}
												?>
											</select>
                        
                            
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fiscal">No. Comprobante</label>
                        <div id="outer_comprobante"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div id="resultados4"></div>
                    </div>
                    <div id="resultados5"></div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="condiciones">Pago</label>
                        <select class="form-control input-sm condiciones" id="condiciones" name="condiciones" onchange="showDiv(this)">
                            <option value="1">Efectivo</option>
                            <option value="2">Cheque</option>
                            <option value="3">Transferencia bancaria</option>
                            <option value="4">Crédito</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div id="resultados3"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="condiciones">Forma de Pago</label>
                        <select class="form-control" id="formaPago" name="formaPago" required="required">
                            <option value="01">SIN UTILIZACION DEL SISTEMA FINANCIERO</option>
                            <option value="15">COMPENSACIÓN DE DEUDAS</option>
                            <option value="16">TARJETA DE DÉBITO</option>
                            <option value="17">DINERO ELECTRÓNICO</option>
                            <option value="18">TARJETA PREPAGO</option>
                            <option value="19">TARJETA DE CRÉDITO</option>
                            <option value="20">OTROS CON UTILIZACION DEL SISTEMA FINANCIERO</option>
                            <option value="21">ENDOSO DE TÍTULOS</option>

                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="condiciones">Plazo D&iacute;as</label>
                        <input type="text" class="form-control" id="plazodias" name="plazodias" required="required">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-danger waves-effect waves-light" aria-haspopup="true" aria-expanded="false" id="btn_actualizar"><span class="fa fa-refresh"></span> Actualizar</button>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary waves-effect waves-light" onclick="guardar_cotizacion()"><span class="ti-shopping-cart-full"></span> Facturar</button>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
        // Cuando el valor del input cambie
        $('#rnc1').on('input', function() {
            // Obtener el valor del input
            var nuevoRNC = $(this).val();
            id_cliente=$('#id_cliente1').val();
            //alert();
            // Enviar el nuevo RNC al servidor mediante AJAX
            $.ajax({
                url: '../ajax/actualizar_rcn.php', // Ruta del archivo PHP que procesará la actualización
                type: 'POST',
                data: { rnc: nuevoRNC, id_cliente:id_cliente, }, // Datos a enviar al servidor
                success: function(response) {
                    // Manejar la respuesta del servidor (puede ser un mensaje de éxito o error)
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Manejar errores de la petición AJAX
                    console.error(xhr.responseText);
                }
            });
        });
        
        function guardar_cotizacion() {
    //alert()
    $('#btn_guardar').attr("disabled", true);
    var id_cliente = $("#id_cliente1").val();
    var cotizacion = $("#cotizacion").val();
    var factura = $("#factura").val();
    //alert(factura)
    var id_comp = $("#id_comp").val();
    var tip_doc = $("#tip_doc").val();
    var trans = $("#trans").val();
    
    var formaPago = $("#formaPago").val();
    var plazodias = $("#plazodias").val();
    
    var condiciones = $("#condiciones").val();
    var resibido = $("#resibido").val();
    if (id_cliente == "") {
        $.Notification.notify('error', 'bottom center', 'NOTIFICACIÓN', 'SELECCIONAR UN CLIENTE VALIDO')
        $("#nombre_cliente").focus();
        $('#btn_guardar').attr("disabled", false);
        return false;
    }
    parametros = {
        'id_cliente': id_cliente,
        'cotizacion': cotizacion,
        'factura': factura,
        'id_comp': id_comp,
        'tip_doc': tip_doc,
        'trans': trans,
        'condiciones': condiciones,
        'formaPago': formaPago,
        'plazodias': plazodias,
        'resibido': resibido
    };
    $.ajax({
        type: "POST",
        url: "../ajax/guardar_venta_cot.php",
        data: parametros,
        beforeSend: function(objeto) {
            $("#resultados_ajaxf").html('<img src="../../img/ajax-loader.gif"> Cargando...');
        },
        success: function(datos) {
            $("#resultados_ajaxf").html(datos);
            $('#btn_guardar').attr("disabled", false);
            $("#resultados").load("../ajax/editar_tmp_cot.php"); // carga los datos nuevamente
            $("#barcode").focus();
            load(1);
            //desaparecer la alerta
            $(".alert-success").delay(400).show(10, function() {
                $(this).delay(2000).hide(10, function() {
                    $(this).remove();
                });
            }); // /.alert
        }
    });
    event.preventDefault();
};
    </script>