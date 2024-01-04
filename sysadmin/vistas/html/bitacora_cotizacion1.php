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
$modulo = "Pedidos";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$title  = "Ventas";
$ventas = 1;
?>

<?php require 'includes/header_start.php'; ?>

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
                    <div class="col-lg-12">
                        <div class="portlet">
                            <div class="portlet-heading bg-primary">
                                <h3 class="portlet-title">
                                    Historial de pedidos
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
                                    include "../modal/eliminar_factura.php";
                                    include "../modal/cambiar_estado_guia.php";

                                    ?>

                                    <form class="form-horizontal" role="form" id="datos_cotizacion">
                                        <div class="form-group row">
                                            <div class="col-md-5">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="q" placeholder="Nombre del cliente o # factura" onkeyup='load(1);'>
                                                    <select onchange="buscar(this.value)" id="tienda_q" class="form-control">
                                                        <option value="0"> Seleccione Tienda </option>
                                                        <?php

                                                        //echo "select * from estado_guia";
                                                        $query_categoria = mysqli_query($conexion, "select distinct tienda from facturas_cot");
                                                        while ($rw = mysqli_fetch_array($query_categoria)) {
                                                        ?>
                                                            <option value="<?php echo $rw['tienda']; ?>"><?php echo $rw['tienda']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <select onchange="buscar_estado(this.value)" name="estado_q" class="form-control" id="estado_q">
                                                        <option value="0"> Seleccione Estado </option>
                                                        <?php

                                                        //echo "select * from estado_guia";
                                                        $query_categoria = mysqli_query($conexion, "select * from estado_courier where codigo IN (1,2,3,4,5,6,7,8,9,10,14)");
                                                        while ($rw = mysqli_fetch_array($query_categoria)) {
                                                        ?>
                                                            <option value="<?php echo $rw['codigo']; ?>"><?php echo $rw['alias']; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>

                                                    <span class="input-group-btn">
                                                        <button type="button" class="btn btn-info waves-effect waves-light" onclick='load(1);'>
                                                            <span class="fa fa-search"></span></button>
                                                    </span>

                                                    <button class="btn btn-outline-danger" onclick="pdf(event)">Generar Impresiones</button>
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <span id="loader"></span>
                                                <span id="modal_cot"></span>

                                            </div>

                                        </div>
                                    </form>
                                    <div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
                                    <div class='outer_div'></div><!-- Carga los datos ajax -->
                                    <div class="col-md-4 input-group ">
                                        <label for="numero_q">Numero de facturas a ver: </label>
                                        <select onchange="buscar_numero(this.value)" name="numero_q" class="form-control" id="numero_q">
                                            <option value="10"> 10 </option>
                                            <option value="20"> 20 </option>
                                            <option value="50"> 50 </option>
                                            <option value="100"> 100 </option>

                                        </select>
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
<script>
    async function validar_laar(guia, cot) {
        if (guia == 0) {
            return false;
        }
        let data = await fetch('https://api.laarcourier.com:9727/guias/' + guia, {
            method: 'GET',
        })
        let result = await data.json();
        let resultado = [];
        if (result["novedades"].length > 0) {
            result["novedades"].forEach(element => {
                if (element["codigoTipoNovedad"] == 42 || element["codigoTipoNovedad"] == 96) {
                    resultado["estado_codigo"] = 9;
                    //sale del ciclo
                    return false;
                } else {
                    resultado["estado_codigo"] = result["estadoActualCodigo"];
                }
            });
        } else {
            resultado["estado_codigo"] = result["estadoActualCodigo"];
        }
        resultado["noGuia"] = result["noGuia"];

        $.ajax({
            url: "./bitacora_cotizacion_new.php",
            type: "POST",
            data: {
                "guia": resultado["noGuia"],
                "estado": resultado["estado_codigo"],
                "cot": cot

            },
        })
        let url_descarga = "https://api.laarcourier.com:9727/guias/pdfs/DescargarV2?guia=" + guia;
        let url_VISTA = "https://fenix.laarcourier.com/Tracking/Guiacompleta.aspx?guia=" + guia;
        $.ajax({
            url: "../ajax/guardar_guia_new.php",
            type: "POST",
            data: {
                "guia": resultado["noGuia"],
                "estado": resultado["estado_codigo"],
                "cot": cot
            },
            beforeSend: function(objeto) {

                $("#estados_laar_" + cot).html('<img src="../../img/ajax-loader.gif"> Cargando...');
            },
            success: function(data) {
                const estado_laar = document.querySelector("#estados_laar_" + cot);
                let color_badge = ""

                if (resultado["estado_codigo"] == 1) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-danger'><span> Anulado</span></a><BR>`;
                } else if (resultado["estado_codigo"] == 2) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-purple'>Por recolectar</a><BR>`
                    color_badge += `<a href='${url_descarga}' target="blank"><span> ${guia}</span> </a><BR>`
                    color_badge += `<a style="cursor: pointer;" href="${url_VISTA}" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>`

                } else if (resultado["estado_codigo"] == 3) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-purple'><span>Recolectado</span></a><BR>`
                    color_badge += `<a href='${url_descarga}' target="blank"><span> ${guia} </span></a>`
                    color_badge += `<a style="cursor: pointer;" href="${url_VISTA}" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>`

                } else if (resultado["estado_codigo"] == 4) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-purple'><span>En bodega</span></a><BR>`
                    color_badge += `<a href='${url_descarga}' target="blank"> <span>${guia}</span> </a><BR>`
                    color_badge += `<a style="cursor: pointer;" href="${url_VISTA}" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>`

                } else if (resultado["estado_codigo"] == 5) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-warning'><span>En Transito</span></a><BR>`
                    color_badge += `<a href='${url_descarga}' target="blank"><span> ${guia} </span></a><BR>`
                    color_badge += `<a style="cursor: pointer;" href="${url_VISTA}" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>`

                } else if (resultado["estado_codigo"] == 6) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-purple'><span>Zona de Entrega</span></a><BR>`
                    color_badge += `<a href='${url_descarga}' target="blank"> <span>${guia}</span> </a><BR>`
                    color_badge += `<a style="cursor: pointer;" href="${url_VISTA}" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>`

                } else if (resultado["estado_codigo"] == 7) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-purple'><span>Entregado</span></a><BR>`
                    color_badge += `<a href='${url_descarga}' target="blank"> <span>${guia}</span> </a><BR>`
                    color_badge += `<a style="cursor: pointer;" href="${url_VISTA}" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>`

                } else if (resultado["estado_codigo"] == 8) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-danger'><span>Anulado</span></a><BR>`
                    color_badge += `<a href='${url_descarga}' target="blank"> <span>${guia}</span> </a><BR>`
                    color_badge += `<a style="cursor: pointer;" href="${url_VISTA}" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>`

                } else if (resultado["estado_codigo"] == 9) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-danger'><span>Devolucion</span></a><BR>`
                    color_badge += `<a href='${url_descarga}' target="blank"> <span>${guia}</span> </a><BR>`
                    color_badge += `<a style="cursor: pointer;" href="${url_VISTA}" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>`

                } else if (resultado["estado_codigo"] == 10) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-purple'><span>Facturado</span></a><BR> `
                    color_badge += `<a href='${url_descarga}' target="blank"> <span>${guia}</span> </a><BR>`
                    color_badge += `<a style="cursor: pointer;" href="${url_VISTA}" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>`
                } else if (resultado["estado_codigo"] == 11) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-warning'><span>En Transito</span></a><BR>`
                    color_badge += `<a href='${url_descarga}' target="blank"><span> ${guia} </span></a><BR>`
                    color_badge += `<a style="cursor: pointer;" href="${url_VISTA}" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>`

                } else if (resultado["estado_codigo"] == 12) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-warning'><span>En Transito</span></a><BR>`
                    color_badge += `<a href='${url_descarga}' target="blank"><span> ${guia} </span></a><BR>`
                    color_badge += `<a style="cursor: pointer;" href="${url_VISTA}" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>`

                } else if (resultado["estado_codigo"] == 13) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-warning'><span>En Transito</span></a><BR>`
                    color_badge += `<a href='${url_descarga}' target="blank"><span> ${guia} </span></a><BR>`
                    color_badge += `<a style="cursor: pointer;" href="${url_VISTA}" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>`

                } else if (resultado["estado_codigo"] == 14) {
                    color_badge = `<a href='${url_descarga}' class='badge badge-danger'><span>Con Novedad</span></a><BR>`
                    color_badge += `<a href='${url_descarga}' target="blank"><span> ${guia}</span> </a><BR>`
                    color_badge += `<a style="cursor: pointer;" href="${url_VISTA}" target="blank"><img width="40px" src="../../img_sistema/rastreo.png" alt="" /></a>`

                }
                estado_laar.innerHTML = color_badge;

            }
        });

    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function checkall() {
        const checks = document.querySelectorAll("[name='item']")
        checks.forEach(element => {
            element.checked = !element.checked;
        });
    }
</script>

<script>
    function generatePDF(factura) {
        // Choose the element that our invoice is rendered in.
        let opt = {
            margin: 1,
            filename: 'myfile.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };
        // Choose the element and save the PDF for our user.
        html2pdf()
            .from(factura)
            .save();
    }

    function pdf(e) {
        e.preventDefault();
        let manifiesto_html = `
        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guia Impresas</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr;

        padding: 10px;
    }

    .grid-container>article {
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding-top: 1em;
    }

    .grid-container>article:nth-child(even) {
        border-left: none;
    }

    .grid-container-multiple {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        padding: 0px 10px;
    }

    .grid-container-multiple>article {
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding-top: 1em;
    }

    .grid-container-multiple>article:nth-child(even) {
        border-left: none;
    }

    .grid-container-multiple>article:nth-child(2) {
        border-right: none;
    }

    .grid-container-multiple>article:nth-child(4) {
        border-right: none;
    }

    .grid-container-simple {
        display: grid;
        grid-template-columns: 1fr;
        padding: 10px;
    }

    .grid-container-simple>article {
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding-top: 1em;
    }

    /*  al ultimo ponle padding-buttom */
    .grid-container-simple>article:last-child {
        padding-bottom: 2em;
    }

    .table {
        padding: 10px;
    }

    table {
        border-collapse: collapse;
    }

    table tr th {
        width: 100%;
        border: 1px solid rgba(0, 0, 0, 0.8);
        border-spacing: 0px;
        text-align: start;
        padding: 0% 30px 0px 5px;
    }

    table tr td {
        width: 100%;
        border-spacing: 0px;
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding: 0px 30px 0px 5px;
    }

    .grid-container-title {
        display: grid;
        grid-template-columns: auto 1fr;
        padding: 10px;

    }

    .grid-container-title>article {
        border: 1px solid rgba(0, 0, 0, 0.8);
        padding-top: 1em;
    }

    .grid-container-title>article:nth-child(even) {
        border-left: none;
    }

    .grid-container-title>article:first-child {
        padding-right: 2em;
    }
</style>

<body>
    <main>
        `;
        let checks = document.querySelectorAll("[name='item']:checked");
        if (checks.length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debe seleccionar al menos una factura',
            })
            return false;
        }

        let impresiones = [];
        if (checks.length === 1) {

            checks.forEach(element => {
                $.ajax({
                    url: "../ajax/impresiones.php",
                    type: "POST",
                    data: {
                        "factura": element.id,
                        "tipo": "simple"
                    },
                    beforeSend: function(objeto) {
                        Swal.fire({
                                title: 'Generando PDF',
                                html: 'Por favor espere un momento',
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                            }

                        )
                    },
                    onSuccess: function(data) {

                    }
                }).done(function(data) {
                    let datos = JSON.parse(data);
                    console.log(datos);
                    manifiesto_html += datos["manifiesto"];
                    manifiesto_html += datos["producto"];
                    manifiesto_html += `</main>
                    
            </body>
            </html>
            
                `;
                    generatePDF(manifiesto_html);
                });
            })
        } else {
            let checks_array = [];
            checks.forEach(element => {
                checks_array.push(element.id);
            });
            $.ajax({
                url: "../ajax/impresiones.php",
                type: "POST",
                data: {
                    "factura": checks_array,
                    "tipo": "multiple"
                },
                beforeSend: function(objeto) {
                    Swal.fire({
                            title: 'Generando PDF',
                            html: 'Por favor espere un momento',
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading()
                            },
                        }

                    )
                },
                onSuccess: function(data) {
                    impresiones.push(data);
                }
            }).done(function(data) {
                let datos = JSON.parse(data);
                console.log(datos);
                manifiesto_html += datos["manifiesto"];
                manifiesto_html += `</main>
            </body>
            </html>
            
                `;
                generatePDF(manifiesto_html);
            });



        }

        //generatePDF();

    }
</script>
<script type="text/javascript" src="../../js/bitacora_cotizacion1.js"></script>
<script src="../ajax/js/wallet.js"></script>
<?php require 'includes/footer_end.php'
?>