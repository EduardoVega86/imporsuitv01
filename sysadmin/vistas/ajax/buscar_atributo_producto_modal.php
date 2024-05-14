<?php
/*-------------------------
Autor: Eduardo Vega
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';

if ($action == 'agrega') {
    $atributo= $_REQUEST['atributo'];
   
    $id_producto=$_REQUEST['id_producto'];
    
   $sql = "INSERT INTO `atributo_producto` (`atributo`, `id_producto`) VALUES "
           . " ('$atributo', '$id_producto')";
   //echo $sql;
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
            $messages[] = "Gasto ha sido ingresado con Exito.";
        } else {
            $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
        } 
}
if ($action == 'elimina') {
   
    $id_stock=$_REQUEST['id_stock'];
    
   $sql = "delete from `atributo_producto` where id_atributo=".$id_stock;
   //echo $sql;
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
            $messages[] = "Gasto ha sido ingresado con Exito.";
        } else {
            $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
        } 
}

    // escaping, additionally removing everything that could be (html/javascript-) code
  
    //$q        = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    //$aColumns = array(); //Columnas de busqueda
    $sTable   = "atributos";
    $sWhere   = "";
    
    include 'pagination.php'; //include pagination file
    //pagination variables
    
    //Count the total number of row in your table*/
   
    //main query to fetch the data
    $sql   = "SELECT * FROM  $sTable $sWhere ";
    //echo $sql;
    $query = mysqli_query($conexion, $sql);
    //loop through fetched data


        ?>

<div style="padding-left: 10px; padding-right: 10px" class="table-responsive">
    <form id="miFormulariomodal">
    <table class="table table-bordered table-striped table-sm">
       

        <tr class="info">
            <th class='text-center'>ATRIBUTO</th>
            <th class='text-center' ></th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($query)) {
            $id_atributo = $row['id_atributo'];
            $atributo = $row['nombre_atributo'];
          
        ?>
            <tr>
                <td style="width: 10%;"><?php echo htmlspecialchars($atributo); ?></td>
                <td style="width: 50%;" class='text-left'>
                <?php
                  $sql2="select * from variedades where id_atributo=$id_atributo";
                  //echo $sql2 ;
             $query2 = mysqli_query($conexion, $sql2);
            while ($row2 = mysqli_fetch_array($query2)) {
                 $id_variedad = $row2['id_variedad'];
                 $nombre_variedad = $row2['variedad'];
echo "<span onclick='agregarFila(" . $id_variedad . ", \"" . addslashes($nombre_variedad) . "\")' style='margin-left:5px' class='badge badge-primary'>" . strtoupper($row2['variedad']) . "<a href='#' style='margin-left:5px; margin-bottom:15px' onclick='eliminar_var_modal(" . $id_variedad . ")'>x</a></span>";

            }?>
                     </td>
                <td style="width: 40%;" class='text-left'>
                    <input type="text" class="form-control descripcion_id_modal formulario" style="text-align:center; font-size:10px;" value="" id="<?php echo $id_atributo; ?>">
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
        </form>
</div>
<script>
 $(".descripcion_id_modal").on("change", function(event) {
           //  alert()
         id_tmp = $(this).attr("id");
        descripcion = $(this).val();
        $.ajax({
            type: "POST",
            url: "../ajax/nuevo_variable.php",
            data: "id_tmp=" + id_tmp + "&descripcion=" + descripcion,
            success: function(datos) {
              //$("#resultados").load("../ajax/agregar_tmp.php");
               $.Notification.notify('success','bottom center','EXITO!', 'ATRIBUTO ACTUALIZADO CORRECTAMENTE')
                   document.getElementById('miFormulariomodal').reset();
                   atributos_producto();

           }
       });
    });
    
    function eliminar_var_modal(id){
        //alert()
         $.ajax({
            type: "POST",
            url: "../ajax/eliminar_variable.php",
            data: "id_tmp=" + id,
            success: function(datos) {
               //$("#resultados").load("../ajax/agregar_tmp.php");
               $.Notification.notify('success','bottom center','EXITO!', 'ATRIBUTO ACTUALIZADO CORRECTAMENTE')
                   document.getElementById('miFormulariomodal').reset();
                   atributos_producto();

           }
       });
    }
    function agregarFila(atributo, nombre) {
    var attribute = atributo;
    var nombre = nombre;
    
    // Realizar una petición AJAX para obtener las opciones del select desde la base de datos
    $.ajax({
        url: '../ajax/obtener_opciones_select.php', // Reemplaza 'obtener_opciones_select.php' con la ruta correcta a tu script PHP
        method: 'GET',
        dataType: 'json',
        success: function(opciones) {
            var options = '';
            // Construir las opciones del select
            opciones.forEach(function(opcion) {
                options += `<option value="${opcion.valor}">${opcion.etiqueta}</option>`;
            });
            
            // Crear la nueva fila con el select y los demás elementos
            var newRow = `<tr>
               
                <td><input class="form-control" type="hidden" value='${attribute}' name="id_${attribute}" />${nombre}</td>
                <td><input class="form-control formulario" type="text" name="stock_${attribute}" /></td>
                <td><input class="form-control formulario" type="text" name="precio_${attribute}" /></td>
                    <td><select class="form-control" name="select_${attribute}">${options}</select></td>
                <td><button type="button" class="remove-row">x</button></td>
            </tr>`;
            
            // Agregar la nueva fila a la tabla dinámica
            $('#tabla-dinamica tbody').append(newRow);
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener las opciones del select:', error);
        }
    });
}
    
      $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
    });
    
    </script>