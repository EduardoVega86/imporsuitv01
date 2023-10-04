<style>
.superior {
  background-color: <?php echo get_row('perfil', 'color', 'id_perfil', '1')?> !important;
}
.footer {
  background-color: <?php echo get_row('perfil', 'color_footer', 'id_perfil', '1')?> !important;
}
.boton {
  background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
  border-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;

}

.comparison-table__row-name {
    color:<?php echo get_row('perfil', 'texto_cabecera', 'id_perfil', '1')?> !important;
    background-color:<?php echo get_row('perfil', 'color', 'id_perfil', '1')?> !important;
}

.boton2 {
  background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
  border-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
  border-radius: 25px;
  height: 60px;
}
.boton2:hover {

    margin-bottom: 2px;

    box-shadow: inset 0 0 10px 0 white;;

  }
.menu_activo{
 background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
 // padding: 5px;
  border-radius: 5px;
 
   
}
    
.migas_enlace{
  font-weight: bold !important;
  color: <?php echo get_row('perfil', 'color', 'id_perfil', '1')?>
}
.migas{
  color: <?php echo get_row('perfil', 'color', 'id_perfil', '1')?>
}
.texto_cabecera{
   color: <?php echo get_row('perfil', 'texto_cabecera', 'id_perfil', '1')?> !important; 
}
.texto_boton{
    color: <?php echo get_row('perfil', 'texto_boton', 'id_perfil', '1')?> !important; 
}  
.texto_footer{
    color: <?php echo get_row('perfil', 'texto_footer', 'id_perfil', '1')?> !important; 
} 

.precio_oferta{
    color: <?php echo get_row('perfil', 'texto_precio', 'id_perfil', '1')?> !important; 
    font-weight: bold;
} 
.precio_normal{
    font-weight: bold;
}

.ahorro{
    color: #ea2929;
    border-style: solid;
    border-radius: 7px;
    padding: 3px;
    font-size:11px
} 

.contactos{
 background-color: #f3f3f3 !important; 
}

.btn-flotante {
	font-size: 16px; /* Cambiar el tamaè´–o de la tipografia */
	text-transform: uppercase; /* Texto en mayusculas */
	font-weight: bold; /* Fuente en negrita o bold */
	color: #ffffff; /* Color del texto */
	border-radius: 5px; /* Borde del boton */
	letter-spacing: 2px; /* Espacio entre letras */
	background-color: #2db742; /* Color de fondo */
	padding: 18px 30px; /* Relleno del boton */
	position: fixed;
	bottom: 40px;
	right: 40px;
	transition: all 300ms ease 0ms;
	box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
	z-index: 99;
}
.btn-flotante:hover {
	 background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
	box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
	transform: translateY(-7px);
}
@media only screen and (max-width: 600px) {
 	.btn-flotante {
		font-size: 14px;
		padding: 12px 20px;
		bottom: 20px;
		right: 20px;
	}
}



.btn-flotante-producto {
	font-size: 16px; /* Cambiar el tamaè´–o de la tipografia */
	text-transform: uppercase; /* Texto en mayusculas */
	font-weight: bold; /* Fuente en negrita o bold */
	color: #ffffff; /* Color del texto */
	border-radius: 5px; /* Borde del boton */
	letter-spacing: 2px; /* Espacio entre letras */
	background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
	padding: 18px 30px; /* Relleno del boton */
	position: fixed;
	bottom: 40px;
	right: 40px;
	transition: all 300ms ease 0ms;
	box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
	z-index: 99;
}
.btn-flotante-producto:hover {
	background-color: <?php echo get_row('perfil', 'color_botones', 'id_perfil', '1')?> !important;
	box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
	transform: translateY(-7px);
}
@media only screen and (max-width: 600px) {
 	.btn-flotante-producto {
		font-size: 14px;
		padding: 12px 20px;
		bottom: 20px;
		right: 20px;
	}
}


  </style>