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
    .left-column {
        width: 50%;
        padding: 20px;
        padding-top: 60px;
        position: -webkit-sticky;
        /* Para compatibilidad con Safari */
        position: sticky;
        top: 0;
        /* Ajusta esto a la altura de cualquier cabecera o menú que tengas */
        height: 100%;
        /* O la altura que quieras que tenga */
    }

    .right-column {
        width: 50%;
        padding: 20px;
        padding-top: 60px;
    }

    /* Seccion Hidden */
    .list-group-item {
        display: flex;
        flex-direction: column;
        /* Asegura que el contenido fluya de arriba hacia abajo */
    }

    .edit-section {
        width: 100%;
        /* Ocupa todo el ancho disponible */
        /* Otros estilos que desees aplicar */
    }

    .hidden {
        display: none;
        /* Oculta la sección */
    }

    /* Este estilo se aplica cuando se muestra la sección */
    .edit-section:not(.hidden) {
        display: block;
        /* O 'flex' si necesitas más control sobre el contenido interior */
    }

    .caja_transparente {
        border-radius: 0.5rem;
        border: 1px solid #ccc;
        padding: 10px;
    }

    .caja_variable {
        padding-top: 10px;
        padding-right: 10px !important;
        padding-left: 10px !important;
        border-radius: 0.5rem;
        background-color: #dedbdb;
    }

    .discount-code-container {
        max-width: 300px;
        /* O el ancho que prefieras */
        padding-top: 10px;
    }

    .applied-discount {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
        padding: 5px 10px;
        background: #f2f2f2;
        /* Fondo gris claro para destacar */
        border-radius: 5px;
    }

    .discount-tag {
        font-weight: bold;
    }

    .close {
        font-size: 20px;
        color: #000;
        opacity: 0.6;
    }

    .close:hover {
        opacity: 1;
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
            <div class="container d-flex flex-row">
                <div class="left-column">
                    <div class="container mt-5">
                        <!-- Instrucciones -->
                        <div class="alert alert-secondary">
                            <ul>
                                <li>Los bloques rojos están desactivados en tu formulario. Usa el botón del ojo para habilitarlos.</li>
                                <li>Los bloques blancos están activos en tu formulario.</li>
                                <li>Clica en el botón lápiz para editar un bloque.</li>
                                <li>Clica en los botones de flechas para cambiar la posición de un bloque.</li>
                            </ul>
                        </div>

                        <!-- Lista de componentes del formulario -->
                        <div class="list-group">
                            <!-- Elemento del formulario -->
                            <!-- TÍTULO DEL FORMULARIO -->
                            <div class="list-group-item" id="tituloFormulario">
                                <div class="d-flex justify-content-between align-items-center">
                                    TÍTULO DEL FORMULARIO
                                    <span>
                                        <button class="btn btn-secondary btn-sm edit-btn"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="btn btn-secondary btn-sm move-up"><i class="fas fa-arrow-up"></i></button>
                                        <button class="btn btn-secondary btn-sm move-down"><i class="fas fa-arrow-down"></i></button>
                                    </span>
                                </div>
                                <!-- Sección oculta que se mostrará al hacer clic en editar -->
                                <div class="edit-section hidden">
                                    <form>
                                        <div class="form-group">
                                            <label for="texto_titulo">Texto</label>
                                            <input type="text" class="form-control" id="texto_titulo" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword3" class="col-sm-2 col-form-label">Alineacion</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" name="alineacion_titulo" id="alineacion_titulo">
                                                    <option value="1">Izquierda </option>
                                                    <option value="2">Centro </option>
                                                    <option value="3">Derecha </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="colorTxt_titulo">Color texto titulo</label>
                                            <input class="colores input-change" type="color" name="colorTxt_titulo" value="">
                                        </div>
                                        <!-- Añade más campos según sea necesario -->
                                    </form>
                                </div>
                            </div>
                            <!-- Fin TÍTULO DEL FORMULARIO -->

                            <!-- Resumen Total... -->
                            <div class="list-group-item" id="resumenTotal">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-secondary btn-sm toggle-visibility"><i class="fas fa-eye"></i></button>
                                    RESUMEN TOTAL
                                    <span>
                                        <button class="btn btn-secondary btn-sm edit-btn"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="btn btn-secondary btn-sm move-up"><i class="fas fa-arrow-up"></i></button>
                                        <button class="btn btn-secondary btn-sm move-down"><i class="fas fa-arrow-down"></i></button>
                                    </span>
                                </div>
                                <!-- Sección oculta que se mostrará al hacer clic en editar -->
                                <div class="edit-section hidden">
                                    <form>
                                        <div class="form-group">
                                            <label for="subtotal">Texto subtotal</label>
                                            <input type="text" class="form-control" id="subtotal" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="envio">Texto envío</label>
                                            <input type="text" class="form-control" id="envio" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="total">Texto total</label>
                                            <input type="text" class="form-control" id="total" placeholder="">
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="impuestos">
                                            <label class="form-check-label" for="impuestos">Mostrar mensaje adicional sobre impuestos</label>
                                        </div>
                                        <!-- Añade más campos según sea necesario -->
                                    </form>
                                    <small class="form-text text-muted">
                                        Importante: cambiar el color de fondo de este bloque podría afectar negativamente a su tasa de conversión.
                                    </small>
                                </div>
                            </div>
                            <!-- Fin Resumen Total... -->
                            <!-- TARIFAS DE ENVIO. -->
                            <div class="list-group-item" id="tarifasEnvio">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-secondary btn-sm toggle-visibility"><i class="fas fa-eye"></i></button>
                                    TARIFAS DE ENVIO
                                    <span>
                                        <button class="btn btn-secondary btn-sm edit-btn"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="btn btn-secondary btn-sm move-up"><i class="fas fa-arrow-up"></i></button>
                                        <button class="btn btn-secondary btn-sm move-down"><i class="fas fa-arrow-down"></i></button>
                                    </span>
                                </div>
                                <!-- Sección oculta que se mostrará al hacer clic en editar -->
                                <div class="edit-section hidden">
                                    <form>
                                        <div class="form-group">
                                            <label for="titulo_tarifa">Título</label>
                                            <input type="text" class="form-control" id="titulo_tarifa" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="envio">Gratis</label>
                                            <input type="text" class="form-control" id="gratis" placeholder="">
                                        </div>
                                        <!-- Añade más campos según sea necesario -->
                                    </form>
                                </div>
                            </div>
                            <!-- Fin TARIFAS DE ENVIO -->
                            <!-- CODIGOS DE DESCUENTO -->
                            <div class="list-group-item" id="codigosDescuento">
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-secondary btn-sm toggle-visibility"><i class="fas fa-eye"></i></button>
                                    CODIGOS DE DESCUENTO
                                    <span>
                                        <button class="btn btn-secondary btn-sm edit-btn"><i class="fas fa-pencil-alt"></i></button>
                                        <button class="btn btn-secondary btn-sm move-up"><i class="fas fa-arrow-up"></i></button>
                                        <button class="btn btn-secondary btn-sm move-down"><i class="fas fa-arrow-down"></i></button>
                                    </span>
                                </div>
                                <!-- Sección oculta que se mostrará al hacer clic en editar -->
                                <div class="edit-section hidden">
                                    <form>
                                        <div class="form-group">
                                            <label for="descuentos">Texto de línea de descuentos</label>
                                            <input type="text" class="form-control" id="descuentos" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="etiqueta_descuento">Etiqueta de campo de Código de descuento</label>
                                            <input type="text" class="form-control" id="etiqueta_descuento" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="textoBtn_aplicar">Texto del botón Aplicar</label>
                                            <input type="text" class="form-control" id="textoBtn_aplicar" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="colorBtn_aplicar">Color boton aplicar</label>
                                            <input class="colores input-change" type="color" name="colorBtn_aplicar" value="">
                                        </div>
                                        <!-- Añade más campos según sea necesario -->
                                    </form>
                                </div>
                            </div>
                            <!-- Fin CODIGOS DE DESCUENTO -->
                        </div>
                    </div>
                </div>

                <div class="right-column">
                    <div class="col-md-8 caja" style="background-color: white;">
                        <div id="previewContainer" class="p-3">

                            <div id="tituloFormularioPreview">
                                <h4 id="texto_tituloPreview">PAGA AL RECIBIR EN CASA!</h4>
                            </div>
                            <div id="resumenTotalPreview" class="caja_variable">
                                <div class="d-flex flex-row">
                                    <p id="subtotalPreview">Subtotal</p>
                                    <span style="width: 100%; text-align: end;">$19.99</span>
                                </div>
                                <div class="d-flex flex-row">
                                    <p>Envío</p>
                                    <span id="envioPreview" style="width: 100%; text-align: end; font-weight:bold;">Gratis</span>
                                </div>

                                <div class="d-flex flex-row">
                                    <p id="descuentosPreview">Descuento</p>
                                    <span style="width: 100%; text-align: end; font-weight:bold; color: red;">- $4.00</span>
                                </div>

                                <div class="d-flex flex-row">
                                    <p id="totalPreview">Total</p>
                                    <span style="width: 100%; text-align: end;">$19.99</span>
                                </div>
                            </div>
                            <div id="tarifasEnvioPreview">
                                <p id="titulo_tarifaPreview" style="font-weight:bold;">Método de envío</p>
                                <div class="caja_transparente d-flex flex-row">
                                    <input type="radio" name="metodoEnvio" checked>
                                    <label for="envioGratisPreview"> Envío gratis</label>
                                    <label id="gratisPreview" style="width: 60%; text-align: end; font-weight:bold;">Gratis</label>
                                </div>
                            </div>
                            <div class="discount-code-container" id="codigosDescuentoPreview">
                                <!-- Campo de entrada para el código de descuento -->
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Código de descuento" aria-label="Código de descuento">
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" type="button">Aplicar</button>
                                    </div>
                                </div>

                                <!-- Código de descuento aplicado -->
                                <div class="applied-discount">
                                    <span class="discount-tag">4SALE $4.00</span>
                                    <button type="button" class="close" aria-label="Eliminar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
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


        // Espera a que el documento esté listo
        $(document).ready(function() {
            // Maneja el evento clic del botón de editar
            $('.edit-btn').click(function() {
                // Encuentra la sección de edición más cercana y alterna la clase 'hidden'
                $(this).closest('.list-group-item').find('.edit-section').toggleClass('hidden');
            });
        });

        // dejar de visualizar o no un codigo
        $(document).ready(function() {
            $('.toggle-visibility').click(function() {
                var listItem = $(this).closest('.list-group-item');
                var listItemID = listItem.attr('id');

                // Alterna la clase 'hidden' en la lista de la izquierda
                listItem.toggleClass('hidden');

                // También alterna la clase 'hidden' en la vista previa correspondiente
                $('#previewContainer').find('#' + listItemID + 'Preview').toggleClass('hidden');

                // Cambia el ícono de visibilidad
                $(this).find('i').toggleClass('fa-eye fa-eye-slash');
            });
        });

        //Flechas de arriba y abajo
        $(document).ready(function() {
            // Mover elemento hacia arriba
            $('.move-up').click(function() {
                var listItem = $(this).closest('.list-group-item');
                var listItemID = listItem.attr('id'); // Asegúrate de que cada list-group-item tenga un id único.

                // Mueve el elemento en la columna de la izquierda
                listItem.prev().before(listItem);

                // Ahora mueve el elemento correspondiente en la columna de la derecha
                var previewItem = $('#previewContainer').find('#' + listItemID + 'Preview');
                previewItem.prev().before(previewItem);
            });

            // Mover elemento hacia abajo
            $('.move-down').click(function() {
                var listItem = $(this).closest('.list-group-item');
                var listItemID = listItem.attr('id'); // Asegúrate de que cada list-group-item tenga un id único.

                // Mueve el elemento en la columna de la izquierda
                listItem.next().after(listItem);

                // Ahora mueve el elemento correspondiente en la columna de la derecha
                var previewItem = $('#previewContainer').find('#' + listItemID + 'Preview');
                previewItem.next().after(previewItem);
            });
        });
        //PREVIEW
        document.addEventListener('DOMContentLoaded', () => {
            // Asumiendo que tienes un input con id='texto_titulo'
            const tituloInput = document.getElementById('texto_titulo');
            tituloInput.addEventListener('input', function() {
                document.getElementById('texto_tituloPreview').textContent = this.value;
            });

            // Asume que tienes otro input para la descripción con id='subtotal'
            const subtotalInput = document.getElementById('subtotal');
            subtotalInput.addEventListener('input', function() {
                document.getElementById('subtotalPreview').textContent = this.value;
            });

            // Repite el proceso para otros campos de entrada
            const envioInput = document.getElementById('envio');
            envioInput.addEventListener('input', function() {
                document.getElementById('envioPreview').textContent = this.value;
            });

            const totalInput = document.getElementById('total');
            totalInput.addEventListener('input', function() {
                document.getElementById('totalPreview').textContent = this.value;
            });

            const titulo_tarifaInput = document.getElementById('titulo_tarifa');
            titulo_tarifaInput.addEventListener('input', function() {
                document.getElementById('titulo_tarifaPreview').textContent = this.value;
            });

            const gratisInput = document.getElementById('gratis');
            gratisInput.addEventListener('input', function() {
                document.getElementById('gratisPreview').textContent = this.value;
            });

            const descuentosInput = document.getElementById('descuentos');
            descuentosInput.addEventListener('input', function() {
                document.getElementById('descuentosPreview').textContent = this.value;
            });
        });

        // Funcion para que consuma los datos de checout_predeterminado.json y los utilice

        document.addEventListener('DOMContentLoaded', function() {
            loadAndSetInitialData();
        });

        function loadAndSetInitialData() {
    $.getJSON('../json/checkout_predeterminado.json', function(data) {
        data.forEach(function(item) {
            // Asignar valores a los campos de entrada y actualizar la vista previa
            Object.keys(item.content).forEach(function(key) {
                var field = $('#' + key);
                var fieldValue = item.content[key];
                var previewField = $('#' + key + 'Preview');

                // Actualizar el valor del campo si existe
                if (field.length) {
                    if (field.is(':checkbox')) {
                        // Caso especial para checkboxes
                        field.prop('checked', fieldValue === 'on');
                    } else {
                        // Para inputs y selects
                        field.val(fieldValue).change(); // Agregamos .change() para disparar el evento
                    }
                } else {
                    console.warn('No se encontró el campo para', key);
                }

                // Actualizar la vista previa si existe
                if (previewField.length) {
                    previewField.text(fieldValue);
                } else {
                    console.warn('No se encontró el campo de vista previa para', key);
                }
            });

            // Reordena los elementos si es necesario
            reorderElement($('#' + item.id_elemento), item.posicion, '.list-group');
            reorderElement($('#' + item.id_elemento + 'Preview'), item.posicion, '#previewContainer');
        });

        // Disparar eventos para actualizar la vista previa
        $('input, select').each(function() {
            $(this).trigger('input');
        });
        
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error('Error al cargar el archivo JSON:', textStatus, errorThrown);
    });
}


        function reorderElement(element, position, containerSelector) {
            if (element.length && element.index() !== position) {
                element.detach();
                if (position === 0) {
                    $(containerSelector).prepend(element);
                } else {
                    $(containerSelector).children().eq(position - 1).after(element);
                }
            }
        }

        // Funcion para crear .json con la informacion de los inputs
        /*
        document.addEventListener('DOMContentLoaded', () => {
            saveInitialState();
        });

        function saveInitialState() {
            var itemList = [];
            $('.list-group-item').each(function(index) {
                var item = {
                    id_elemento: $(this).attr('id'),
                    posicion: index,
                    content: {}
                };
                // Captura tanto inputs como selectores
                $(this).find('input, select').each(function() {
                    item.content[this.id] = $(this).val();
                });
                itemList.push(item);
            });

            // Envía la información al servidor para guardar en el archivo JSON
            $.ajax({
                url: '../ajax/actualizar_checkout.php',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(itemList),
                success: function(response) {
                    console.log('Initial state saved successfully');
                },
                error: function(xhr, status, error) {
                    console.error('Error saving initial state');
                }
            });
        }
        */
    </script>
    <?php require 'includes/footer_end.php'
    ?>