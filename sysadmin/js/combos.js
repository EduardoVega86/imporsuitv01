$(document).ready(function () {
  load(1);
});

function load(page) {
  var q = $("#q").val();
  var categoria = $("#categoria").val();
  $("#loader").fadeIn("slow");
  $.ajax({
    url:
      "../ajax/buscar_combos.php?action=ajax&page=" +
      page +
      "&q=" +
      q +
      "&categoria=" +
      categoria,
    beforeSend: function (objeto) {
      $("#loader").html('<img src="../../img/ajax-loader.gif"> Cargando...');
    },
    success: function (data) {
      $(".outer_div").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}
// Asegurarse de que solo un checkbox pueda ser seleccionado a la vez
$(".product-checkbox").on("change", function () {
  $(".product-checkbox").not(this).prop("checked", false);
});

$("#guardar_combo").submit(function (event) {
  event.preventDefault(); // Prevenir el envío normal del formulario
  $("#guardar_datos").attr("disabled", true);

  // Agregar el ID del producto seleccionado al formulario si es necesario
  if ($(".product-checkbox:checked").length > 0) {
    var selectedProductId = $(".product-checkbox:checked").val();
    // Asegúrate de que el campo exista en el formulario o añade un campo oculto si es necesario
    $("<input>")
      .attr({
        type: "hidden",
        id: "selected_product_id",
        name: "selected_product_id",
        value: selectedProductId,
      })
      .appendTo("#guardar_combo");
  }

  var parametros = $(this).serialize(); // Serializar los datos del formulario

  $.ajax({
    type: "POST",
    url: "../ajax/nuevo_combo.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#resultados_ajax").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
    },
    success: function (datos) {
      $("#resultados_ajax").html(datos);
      $("#guardar_datos").attr("disabled", false);
      load(1);
      $("#guardar_combo")[0].reset(); // Resetea el formulario
      $("#selected_product_id").remove(); // Remover el campo oculto
      window.setTimeout(function () {
        // Desaparecer la alerta
        $(".alert")
          .fadeTo(500, 0)
          .slideUp(500, function () {
            $(this).remove();
          });
      }, 5000);
    },
  });
});

$("#editar_producto1").submit(function (event) {
  //alert()
  $("#actualizar_datos").attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/editar_combos.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#resultados_ajax2").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
    },
    success: function (datos) {
      $("#resultados_ajax2").html(datos);
      $("#actualizar_datos").attr("disabled", false);
      load(1);
      //desaparecer la alerta
      window.setTimeout(function () {
        $(".alert")
          .fadeTo(500, 0)
          .slideUp(500, function () {
            $(this).remove();
          });
      }, 5000);
    },
  });
  event.preventDefault();
});

$("#editar_landing").submit(function (event) {
  $("#actualizar_datos").attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/editar_landing.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#resultados_ajax2").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
    },
    success: function (datos) {
      $("#resultados_ajax2").html(datos);
      $("#actualizar_datos").attr("disabled", false);
      load(1);
      //desaparecer la alerta
      window.setTimeout(function () {
        $(".alert")
          .fadeTo(500, 0)
          .slideUp(500, function () {
            $(this).remove();
          });
      }, 5000);
    },
  });
  event.preventDefault();
});

$("#dataDelete").on("show.bs.modal", function (event) {
  var button = $(event.relatedTarget); // Botón que activó el modal
  var id = button.data("id"); // Extraer la información de atributos de datos
  var modal = $(this);
  modal.find("#id_combo").val(id);
});
$("#eliminarDatos").submit(function (event) {
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/eliminar_combos.php",
    data: parametros,
    beforeSend: function (objeto) {
      $(".datos_ajax_delete").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
    },
    success: function (datos) {
      $(".datos_ajax_delete").html(datos);
      $("#dataDelete").modal("hide");
      load(1);
      //desaparecer la alerta
      window.setTimeout(function () {
        $(".alert")
          .fadeTo(200, 0)
          .slideUp(200, function () {
            $(this).remove();
          });
      }, 2000);
    },
  });
  event.preventDefault();
});

function obtener_datos(id) {
  //alert(id)
  var nombre_combo = $("#nombre_combo" + id).val();
  var valor_combo = $("#valor_combo" + id).val();

  $("#mod_id_combo").val(id);
  $("#mod_nombre_combo").val(nombre_combo);
  $("#mod_valor_combo").val(valor_combo);
}

function obtener_datos_landing(id) {
  // alert(id)

  var url1 = $("#url1" + id).val();
  var boton1 = $("#texto_boton1" + id).val();
  var descripcion1 = $("#descripcion1" + id).val();
  var url2 = $("#url2" + id).val();
  var boton2 = $("#texto_boton2" + id).val();
  var descripcion2 = $("#descripcion2" + id).val();

  $("#mod_id_landing").val(id);
  $("#mod_url1").val(url1);
  $("#mod_boton1").val(boton1);
  $("#mod_descripcion1").val(descripcion1);

  $("#mod_url2").val(url2);
  $("#mod_boton2").val(boton2);
  $("#mod_descripcion2").val(descripcion2);
}

function iva(id) {
  $.ajax({
    url: "../ajax/producto_iva.php?id_notificacion=" + id,
    beforeSend: function (objeto) {
      //$('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
    },
    success: function (data) {},
  });
}

$(document).on("click", ".estado-btn", function () {
  var userId = $(this).data("id");
  //alert($(this).text().trim());
  var newEstado = $(this).text().trim() === "NO" ? 1 : 0; // Cambia el estado
  //alert(newEstado);
  $.ajax({
    url: "../ajax/producto_iva.php?id_notificacion", // Ruta al script PHP que cambiará el estado en la base de datos
    type: "POST",
    data: { id: userId, estado: newEstado },
    success: function (response) {
      // Actualizar el botón según la nueva respuesta de estado
      if (response.trim() == "1") {
        $('button[data-id="' + userId + '"]')
          .text("SI")
          .removeClass("btn-danger")
          .addClass("btn-success");
      } else {
        $('button[data-id="' + userId + '"]')
          .text("NO")
          .removeClass("btn-success")
          .addClass("btn-danger");
      }
    },
  });
});

$(document).on("click", ".estado-destacado", function () {
  var userId = $(this).data("idd");
  //alert($(this).text().trim());
  var newEstado = $(this).text().trim() === "NO" ? 1 : 0; // Cambia el estado
  //alert(newEstado);
  $.ajax({
    url: "../ajax/producto_destacado.php?id_notificacion", // Ruta al script PHP que cambiará el estado en la base de datos
    type: "POST",
    data: { id: userId, estado: newEstado },
    success: function (response) {
      // Actualizar el botón según la nueva respuesta de estado
      if (response.trim() == "1") {
        $('button[data-idd="' + userId + '"]')
          .text("SI")
          .removeClass("btn-danger")
          .addClass("btn-success");
      } else {
        $('button[data-idd="' + userId + '"]')
          .text("NO")
          .removeClass("btn-success")
          .addClass("btn-danger");
      }
    },
  });
});

$(document).on("click", ".estado-habilitado", function () {
  var userId = $(this).data("idd2");
  //alert($(this).text().trim());
  var newEstado = $(this).text().trim() === "NO" ? 1 : 0; // Cambia el estado
  //alert(newEstado);
  $.ajax({
    url: "../ajax/producto_habilitar.php?id_notificacion", // Ruta al script PHP que cambiará el estado en la base de datos
    type: "POST",
    data: { id: userId, estado: newEstado },
    success: function (response) {
      // Actualizar el botón según la nueva respuesta de estado
      if (response.trim() == "1") {
        $('button[data-idd2="' + userId + '"]')
          .text("SI")
          .removeClass("btn-danger")
          .addClass("btn-success");
      } else {
        $('button[data-idd2="' + userId + '"]')
          .text("NO")
          .removeClass("btn-success")
          .addClass("btn-danger");
      }
    },
  });
});

$(document).on("click", ".estado-online", function () {
  var userId = $(this).data("idd3");
  //alert($(this).text().trim());
  var newEstado = $(this).text().trim() === "NO" ? 1 : 0; // Cambia el estado
  //alert(newEstado);
  $.ajax({
    url: "../ajax/producto_online.php?id_notificacion", // Ruta al script PHP que cambiará el estado en la base de datos
    type: "POST",
    data: { id: userId, estado: newEstado },
    success: function (response) {
      // Actualizar el botón según la nueva respuesta de estado
      if (response.trim() == "1") {
        $('button[data-idd3="' + userId + '"]')
          .text("SI")
          .removeClass("btn-danger")
          .addClass("btn-success");
      } else {
        $('button[data-idd3="' + userId + '"]')
          .text("NO")
          .removeClass("btn-success")
          .addClass("btn-danger");
      }
    },
  });
});

function agregarProducto(idProducto, button) {
  var row = $(button).closest("tr");
  var cantidad = row.find(".quantity-input").val();
  var idCombo = $("#id_combo").val(); // Obtiene el valor de id_combo

  var data = {
    id_producto: idProducto,
    id_combo: idCombo,
    cantidad: cantidad,
  };

  $.ajax({
    type: "POST",
    url: "../ajax/agregar_producto_combo.php",
    data: data,
    success: function (response) {
      $("#outer_div_detalle_combo").load(
        "../ajax/carga_detalle_combo.php?id_combo=" + idCombo,
        function (response, status, xhr) {
          if (status == "error") {
            console.error("Error: " + xhr.status + " " + xhr.statusText);
          } else {
            //alert("Producto agregado correctamente!");
          }
        }
      );
    },
    error: function (xhr) {
      console.error("Error en la solicitud AJAX: " + xhr.statusText);
    },
  });
}

function eliminarProducto(idDetalleCombo, button) {
  var idCombo = $("#id_combo").val(); // Obtiene el valor de id_combo
  var data = {
    id_detalle_combo: idDetalleCombo,
    id_combo: idCombo,
  };

  $.ajax({
    type: "POST",
    url: "../ajax/eliminar_producto_combo.php",
    data: data,
    success: function (response) {
      $("#outer_div_detalle_combo").load(
        "../ajax/carga_detalle_combo.php?id_combo=" + idCombo,
        function (response, status, xhr) {
          if (status == "error") {
            console.error("Error: " + xhr.status + " " + xhr.statusText);
          } else {
            //alert("Producto eliminado correctamente!");
          }
        }
      );
    },
    error: function (xhr) {
      console.error("Error en la solicitud AJAX: " + xhr.statusText);
    },
  });
}
