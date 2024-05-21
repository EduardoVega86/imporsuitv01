function cargar() {
  var sesion = $("#session").val();

  //  alert(sesion)
  $.ajax({
    type: "POST",
    url: "ajax/agregar_tmp_modalventas.php",
    data: "sesion=" + sesion,
    beforeSend: function (objeto) {
      $("#resultados").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
      // total = $("#total_c").val();
      //$("#q").val();
      // alert(total)
    },
    success: function (datos) {
      // alert(datos)
      $("#resultados").html(datos);
    },
  });
}
function terminar_compra() {
  sesion = $("#session").val();
  nombre = $("#txt_nombresApellidosPreview").val();
  telefono = $("#txt_telefonoPreview").val();
  ciudad = $("#ciudad_entrega").val();
  direccion = $("#direccion").val();
  cliente = 1;
  //fbq("track", "Purchase");

  $.ajax({
    type: "POST",
    url: "ajax/guardar_cotizacion.php",
    data:
      "session=" +
      sesion +
      "&cliente=" +
      cliente +
      "&txt_nombresApellidosPreview=" +
      nombre +
      "&txt_telefonoPreview=" +
      telefono +
      "&ciudad_entrega=" +
      ciudad +
      "&direccion=" +
      direccion,
    beforeSend: function (objeto) {
      window.location.href = "gracias.php";
    },
    success: function (datos) {
      // $("#resultados").html(datos);
    },
  });
}

function agregar_tmp(id, precio_venta) {
  //fbq("track", "AddToCart");
  //fbq("track", "InitiateCheckout");
  cantidad = 1;
  //Fin validacion
  // alert(id);
  sesion = $("#session").val();
  $.ajax({
    type: "POST",
    url: "ajax/agregar_tmp_modalventas_1.php",
    data:
      "id=" +
      id +
      "&precio_venta=" +
      precio_venta +
      "&cantidad=" +
      cantidad +
      "&operacion=" +
      2 +
      "&sesion=" +
      sesion,
    beforeSend: function (objeto) {
      $("#resultados").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
      // total = $("#total_c").val();
      //$("#q").val();
      // alert(total)
    },
    success: function (datos) {
      // alert(datos)
      $("#resultados").html(datos);
    },
  });
}

function agregar_combo_tmp(producto, descuento_porcentaje, session_id) {
  let cantidad = producto.cantidad;
  let id = producto.id_producto;
  let precio_venta = producto.precio_especial * (1 - (descuento_porcentaje / 100));

  //Fin validacion
  // alert(id);
  $.ajax({
      type: "POST",
      url: "ajax/agregar_tmp_modalventas_1.php",
      data:
          "id=" +
          id +
          "&precio_venta=" +
          precio_venta +
          "&cantidad=" +
          cantidad +
          "&operacion=" +
          2 +
          "&sesion=" +
          session_id +
          "&descuento_porcentaje=" +
          descuento_porcentaje,
      beforeSend: function (objeto) {
          $("#resultados").html(
              '<img src="../../img/ajax-loader.gif"> Cargando...'
          );
          // total = $("#total_c").val();
          //$("#q").val();
          // alert(total)
      },
      success: function (datos) {
          // alert(datos)
          $("#resultados").html(datos);
      },
  });
}

function eliminar(id, estado) {
  var sesion = $("#session").val();

  $.ajax({
    type: "GET",
    url: "ajax/eliminar_tmp.php",
    data: "id=" + id + "&sesion=" + sesion + "&estado_oferta=" + estado,
    beforeSend: function(objeto) {
      $("#resultados").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
    },
    success: function(datos) {
      $("#resultados").html(datos);
    },
  });
}

function eliminar_combo(id, estado, identificado_combo) {
  var sesion = $("#session").val();

  $.ajax({
    type: "GET",
    url: "ajax/eliminar_tmp.php",
    data: "id=" + id + "&sesion=" + sesion + "&estado_oferta=" + estado + "&identificado_combo=" + identificado_combo,
    beforeSend: function(objeto) {
      $("#resultados").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
    },
    success: function(datos) {
      $("#resultados").html(datos);
    },
  });
}

$(document).ready(function() {
  $('#oferta_seleccionada').change(function() {
    var sesion = $("#session").val();
    var estado = $(this).is(':checked') ? 1 : 0;
    console.log("Sesión: ", sesion, "Estado: ", estado); // Depuración para verificar los valores

    $.ajax({
      url: '../ajax/agregar_tmp_modalventas_1.php',
      type: 'POST',
      data: {
        'estado_oferta': estado,
        'sesion': sesion
      },
      beforeSend: function() {
        $("#resultados").html('<img src="../../img/ajax-loader.gif"> Cargando...');
      },
      success: function(response) {
        $("#resultados").html(response);
        console.log('Datos actualizados correctamente.');
      },
      error: function(xhr, status, error) {
        console.error('Error al enviar los datos:', error);
      }
    });
  });
});


