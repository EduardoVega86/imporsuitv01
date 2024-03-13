$(document).ready(function () {
  load(1);
});
$("#editar_linea").submit(function (event) {
  // alert();
  $("#actualizar_datos").attr("disabled", true);
  var parametros = $(this).serialize();
  $.ajax({
    type: "POST",
    url: "../ajax/editar_pedido.php",
    data: parametros,
    beforeSend: function (objeto) {
      $("#resultados_ajax2").html(
        '<img src="../../img/ajax-loader.gif"> Cargando...'
      );
    },
    success: function (datos) {
      $("#resultados_ajax2").html(datos);
      $("#actualizar_datos").attr("disabled", false);
      //load(1);
      let msg = JSON.parse(datos);
      if (msg[0] === "Linea ha sido actualizada con Exito.") {
        $.Notification.autoHideNotify(
          "success",
          "top right",
          "Linea ha sido actualizada con Exito.",
          "Linea ha sido actualizada con Exito."
        );
        load(1);
      } else {
        $.Notification.autoHideNotify(
          "error",
          "top right",
          "Error al actualizar la linea.",
          "Comuniquese con Soporte."
        );
      }
    },
  });
  event.preventDefault();
});
function load(page) {
  var q = $("#q").val();
  var url = "";

  
    url =
      "../ajax/buscar_productos_dropi.php?action=ajax&page=" +
      page +
      "&q=" +
      q +
      "&numero=" +
      numero;

  $("#loader").fadeIn("slow");
  $.ajax({
    url: url,
    beforeSend: function (objeto) {
      $("#loader").html('<img src="../../img/ajax-loader.gif"> Cargando...');
    },
    success: function (data) {
      $(".outer_div").html(data).fadeIn("slow");
      $("#loader").html("");
      $('[data-toggle="tooltip"]').tooltip({
        html: true,
      });
    },
  });
}

function buscar(tienda) {
  // alert(tienda)
  var q = $("#q").val();

  page = 1;
  $("#loader").fadeIn("slow");
  $.ajax({
    url:
      "../ajax/buscar_productos_dropi.php?action=ajax&page=" +
      page +
      "&q=" +
      q,
      
    beforeSend: function (objeto) {
      $("#loader").html('<img src="../../img/ajax-loader.gif"> Cargando...');
    },
    success: function (data) {
      $(".outer_div").html(data).fadeIn("slow");
      $("#loader").html("");
      $('[data-toggle="tooltip"]').tooltip({
        html: true,
      });
    },
  });
}


async function productos(texto){
  if(text != null){
    await ffetch("http://localhost/guias/GenerarGuia/nueva/", {
      method: "POST",
      headers: {
          "Content-Type": "application/json",
          "Authorization": "Zc46Um3cI8Eh9vce6hn9"
      },
      body: JSON.stringify({
          "id": 1,
          "nombre": "Guia 1",
          "descripcion": "Descripcion de la guia 1",
          "fecha": "2020-10-10",
          "id_usuario": 1
      })
  }).then(response => response.json()).then(data => console.log(data)).catch(error => console.log(error))
  }
}