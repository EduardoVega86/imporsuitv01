let indice=1;
let limite=1;
let q = '';
$(document).ready(function () {
  load();
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
  q = $("#q").val();
  if (localStorage.getItem('data_dropi')  === null){
    cargar_datos_storage(q);
  }
  card_productos(q);
}

function card_productos(q,numero_paginacion=1){
  var datos = JSON.parse(localStorage.getItem('data_dropi'));
      indice = numero_paginacion;
      var filtro = datos.length;
      filtro = Math.trunc(filtro / 20) ;
      limite = filtro-1;
      console.log(filtro);
      var html= '<div class= "d-flex flex-column">\n';
      var html= '<div class= "d-flex flex-wrap" style="gap:0px">\n';

      var boton_inicio = (numero_paginacion  * 20 ) - 20;
      var boton_fin = boton_inicio + 20;

      for (boton_inicio ; boton_inicio < boton_fin; boton_inicio++) {
        var info_proveedor= datos[boton_inicio]['user'];
      var ultimo= datos[boton_inicio]['gallery'].length - 1;
      if(datos[boton_inicio]['gallery'].length !== 0){
        if(datos[boton_inicio]['gallery'][ultimo]['urlS3'] === null){
          html += '<div  class="col-md-3 " >\n';
      html += '<div  style="padding:10px"  align="center" class="card" width="500px" height="500px" >\n';
      //imagen
      html += '<div class="view overlay">\n';
      html += '<img class="card-img-top" width="150px" height="180px" src="https://api.dropi.ec/'+datos[boton_inicio]['gallery'][ultimo]['url']+'">\n';
      html += '</div>\n';
      //final de imagen
      html += '<div class="card-body">\n';
      html += '<h6 class="card-title"><strong>'+ datos[boton_inicio]['name'] +'</strong></h6>\n';
      html += '<p class="card-text"><strong>Stock: </strong>'+ datos[boton_inicio]['stock']+'</p>\n';
      html += '<p class="card-text"><strong>Precio de venta:</strong> $ '+ datos[boton_inicio]['sale_price'] +'</p>\n';
      html += '<p class="card-text"><strong>Precio Sugerido:</strong> $ '+ datos[boton_inicio]['suggested_price']+'</p>\n';
      html += '<p class="card-text"><strong>Proveedor:</strong>  '+ info_proveedor['name']+'</p>\n';
      html += '<button type="button" class="btn btn-light-blue btn-md">Descripción</button>\n';
      html += '</div>\n';
      html += '</div>\n';
      html += '</div>\n';
        }else{
      html += '<div  class="col-md-3 " >\n';
      html += '<div  style="padding:10px"  align="center" class="card width="500px" height="500px" >\n';
      //imagen
      html += '<div class="view overlay">\n';
      html += '<img class="card-img-top width="150px" height="180px"" src="https://d39ru7awumhhs2.cloudfront.net/'+datos[boton_inicio]['gallery'][ultimo]['urlS3']+'">\n';
      html += '</div>\n';
      //final de imagen
      html += '<div class="card-body">\n';
      html += '<h6 class="card-title"><strong>'+ datos[boton_inicio]['name'] +'</strong></h6>\n';
      html += '<p class="card-text"><strong>Stock: </strong>'+ datos[boton_inicio]['stock']+'</p>\n';
      html += '<p class="card-text"><strong>Precio de venta:</strong> $ '+ datos[boton_inicio]['sale_price'] +'</p>\n';
      html += '<p class="card-text"><strong>Precio Sugerido:</strong> $ '+ datos[boton_inicio]['suggested_price']+'</p>\n';
      html += '<p class="card-text"><strong>Proveedor:</strong>  '+ info_proveedor['name']+'</p>\n';
      html += '<button type="button" class="btn btn-light-blue btn-md">Descripción</button>\n';
      html += '</div>\n';
      html += '</div>\n';
      html += '</div>\n';
        }
      }else{
        html += '<div  class="col-md-3 " >\n';
      html += '<div  style="padding:10px"  align="center" class="card" width="500px" height="500px" >\n';
      //imagen
      html += '<div class="view overlay">\n';
      html += '<img class="card-img-top" width="150px" height="180px" src="https://cdn.icon-icons.com/icons2/2633/PNG/512/office_gallery_image_picture_icon_159182.png">\n';
      html += '</div>\n';
      //final de imagen
      html += '<div class="card-body">\n';
      html += '<h6 class="card-title"><strong>'+ datos[boton_inicio]['name'] +'</strong></h6>\n';
      html += '<p class="card-text"><strong>Stock: </strong>'+ datos[boton_inicio]['stock']+'</p>\n';
      html += '<p class="card-text"><strong>Precio de venta:</strong> $ '+ datos[boton_inicio]['sale_price'] +'</p>\n';
      html += '<p class="card-text"><strong>Precio Sugerido:</strong> $ '+ datos[boton_inicio]['suggested_price']+'</p>\n';
      html += '<p class="card-text"><strong>Proveedor:</strong>  '+ info_proveedor['name']+'</p>\n';
      html += '<button type="button" class="btn btn-light-blue btn-md">Descripción</button>\n';
      html += '</div>\n';
      html += '</div>\n';
      html += '</div>\n';
      html += '</div>\n';
      }
    }
    html += '</div>\n';

    html += paginacion_productos_dropi(q,filtro,html);

    html += '</div>\n';
    

    cargar_datos_storage_lazy(q);
    $('.outer_div').html(html);
}

function paginacion_productos_dropi(q,filtro,html){
    filtro+=1;
    var numero_paginacion;
    html += '<div class="d-flex justify-content-center">\n';
    html += '<nav aria-label="Page navigation example">\n';
    html += '<ul class="pagination">\n';
    html += '<li class="page-item">\n';
    html += '<a class="page-link" onclick="previus()" aria-label="Previous">\n';
    html += '<span aria-hidden="true">&laquo;</span>\n';
    html += '<span class="sr-only">Previous</span>\n';
    html += '</a>\n';
    html += '</li>\n';
    for (var i=1; i<filtro;i++){
      html += `<li class="page-item" onclick="card_productos('${q}',${i})"><a class="page-link">${i}</a></li>\n`;
    }
    html += '<li class="page-item">\n';
    html += '<a class="page-link" onclick="next()" aria-label="Next">\n';
    html += '<span aria-hidden="true">&raquo;</span>\n';
    html += '<span class="sr-only">Next</span>\n';
    html += '</a>\n';
    html += '</li>\n';
    html += '</ul>\n';
    html += '</nav>\n';
    html += '</div>\n';
    return html;
}

function previus(){
  if (indice != 1)
  card_productos(q,indice-1);
}

function next(){
  if (indice <= limite){
  card_productos(q,indice+1);
  }
}

function cargar_datos_storage_lazy(q){
  var destino_url = "https://api.dropi.ec/api/products/index";
  $.ajax({
    url: destino_url,
    type: "POST",
    headers:{
      'Content-Type': 'application/json',
      'Authorization' : 'Bearer ' + localStorage.getItem('dropi_token'),
    },
    data: JSON.stringify({
      'keywords' : q,
      "pageSize": 500
    }),
    success: function (data) {
      data = data['objects'];
      localStorage.setItem('data_dropi',JSON.stringify(data))
    },
  });
}

function cargar_datos_storage(q){
  var destino_url = "https://api.dropi.ec/api/products/index";
  $.ajax({
    url: destino_url,
    type: "POST",
    headers:{
      'Content-Type': 'application/json',
      'Authorization' : 'Bearer ' + localStorage.getItem('dropi_token'),
    },
    data: JSON.stringify({
      'keywords' : q,
      "pageSize": 500
    }),
    success: function (data) {
      data = data['objects'];
      localStorage.setItem('data_dropi',JSON.stringify(data))
      card_productos(q);
    },
  });
}

const isEmpty = (str) => (!str?.length);

function buscar(tienda) {
  // alert(tienda)
  var q = $("#q").val();

  page = 1;
  $("#loader").fadeIn("slow");
  $.ajax({
    url:
      "../ajax/buscar_productos_dropi.php?action=ajax&page=" + page + "&q=" + q,

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

async function productos(texto) {
  if (text != null) {
    await ffetch("http://localhost/guias/GenerarGuia/nueva/", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Authorization: "Zc46Um3cI8Eh9vce6hn9",
      },
      body: JSON.stringify({
        id: 1,
        nombre: "Guia 1",
        descripcion: "Descripcion de la guia 1",
        fecha: "2020-10-10",
        id_usuario: 1,
      }),
    })
      .then((response) => response.json())
      .then((data) => console.log(data))
      .catch((error) => console.log(error));
  }
}