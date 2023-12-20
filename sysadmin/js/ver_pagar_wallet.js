$(document).ready(function () {
  $("#widgets").load("../ajax/cargar_widget_wallet.php");
  $("#facturas").load("../ajax/cargar_facturas.php");
  load(1);
});
function load(page) {
  var range = $("#range").val();
  var parametros = {
    action: "ajax",
    page: page,
    range: range,
  };
  $("#loader").fadeIn("slow");
  $.ajax({
    url: "../ajax/ver_pagos.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/ajax-loader.gif'>");
    },
    success: function (data) {
      $(".outer_div").html(data).fadeIn("slow");
      $("#loader").html("");
    },
  });
}
$("#add_abono").submit(function (event) {
  $("#guardar_datos").attr("disabled", true);
  var abono = $("#abono").val();
  //Inicia validacion
  if (isNaN(abono)) {
    $.Notification.notify(
      "error",
      "bottom center",
      "NOTIFICACIÓN",
      "El ABONO NO ES UN DATO VALIDO, INTENTAR DE NUEVO"
    );
    $("#abono").focus();
    $("#guardar_datos").attr("disabled", false);
    return false;
  }
  //Fin validacion
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/agregar_abono_wallet.php",
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
      //resetea el formulario
      $("#add_abono")[0].reset();
      //cierra la Modal
      $("#outer_div").load("../ajax/ver_pagos.php");
      $("#widgets").load("../ajax/cargar_widget_wallet.php");
      $("#facturas").load("../ajax/cargar_facturas.php");
      $("#add-stock").modal("hide");
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

function ver_detalles(numero_factura) {
  var parametros = {
    numero_factura: numero_factura,
  };
  $.ajax({
    type: "POST",
    url: "../ajax/ver_detalles.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/ajax-loader.gif'>");
    },
    success: function (datos) {
      $("#loader").html("");
      $("#detalles").html(datos);
      $("#Modal").modal("show");
    },
  });
}

function devolucion(guia_laar) {
  var parametros = {
    guia_laar: guia_laar,
    estado: 9,
  };
  $.ajax({
    type: "POST",
    url: "https://marketplace.imporsuit.com/sysadmin/api/integracion/Laar/devolucion",
    data: parametros,
    beforeSend: function (objeto) {
      $("#loader").html("<img src='../../img/ajax-loader.gif'>");
    },
    success: function (datos) {
      $("#loader").html("");
      $("#outer_div").load("../ajax/ver_pagos.php");
      $("#widgets").load("../ajax/cargar_widget_wallet.php");
      $("#facturas").load("../ajax/cargar_facturas.php");
    },
  });
}
