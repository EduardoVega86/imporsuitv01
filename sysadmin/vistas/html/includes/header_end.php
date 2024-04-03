<link href="../../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="../../assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="../../assets/css/style.css" rel="stylesheet" type="text/css">
<!-- para el autocomplete -->
<link href="../../js/jquery-ui.css" rel="stylesheet" />
<!-- fin autocomplete -->

<script src="../../assets/js/modernizr.min.js"></script>

<!-- CHATWEB -->
<style id="style_chatweb">
	/* Estilo del contenedor del chat */
	.chats {
		z-index: 10000;
	}

	.card-chat-container {
		position: fixed;
		bottom: 105px;
		right: 20px;
		width: 550px;
		max-height: 60%;
		overflow-y: auto;
		background-color: #f8f8f8;
		border: 1px solid #ccc;
		border-radius: 5px;
		display: none;
		z-index: 100000;
	}

	.mensajes-body {
		/* se añade un padding a la izquierda y derecha de 2em */
		padding: 0 2em;

	}

	/* Estilo para .card-chat-header */
	.card-chat-header {
		padding: 0.75rem 1.25rem;
		/* Espaciado interno similar al de un card-header en Bootstrap */
		background-color: #171931;
		/* Color de fondo similar al de un card-header en Bootstrap */
		border-bottom: 1px solid #e1e1e1;
		/* Borde inferior similar al de un card-header en Bootstrap */
		border-radius: 0.25rem;
		/* Bordes redondeados similar a los de un card-header en Bootstrap */
		color: #fff;
	}

	/* Estilos de la burbuja de chat */
	.chat-bubble {
		display: inline-block;
		background-color: transparent;
		color: transparent;
		border-radius: 50%;
		text-align: center;
		cursor: pointer;

	}

	/* Estilos para la imagen dentro del bubble chatweb */
	.bubble-image {
		width: 100%;
		/* Ajustar al 100% del ancho del contenedor */
		height: auto;
		/* Ajustar automáticamente la altura en función del ancho */
		border-radius: 50%;
		/* Borde redondeado para que la imagen sea circular */
		display: block;
		/* Hacer que la imagen sea un bloque para ajustar el tamaño correctamente */
		cursor: pointer;
		/* Cambiar el cursor al pasar sobre la imagen */
	}

	/* Estilos cuando se pasa el cursor sobre la burbuja de chat */
	.chat-bubble:hover {
		color: #0056b3;
	}

	/* Estilo para la burbuja de chat cuando está oculta */
	.chat-bubble.hidden {
		display: none;
		width: 40px;
		height: 40px;
		padding: 0;
		margin-right: 10px;
	}

	.chat-card-footer {
		position: sticky;
		bottom: 0;
		z-index: 2;
		background-color: white;
		padding: 10px;
		border-top: 1px solid #ccc;
	}

	/* Estilo del botón para abrir el chat */
	.chat-bubble {
		cursor: pointer;
		color: white;
		border-radius: 50%;
		text-align: center;
		width: 40px;
		height: 40px;
		line-height: 40px;
		position: fixed;
		bottom: 105px;
		right: 45px;
	}

	.chat-bubble:hover {
		background-color: transparent;
		color: #0056b3;
	}

	.notification-badge {
		position: absolute;
		top: -10%;
		left: -10%;

		background-color: red;
		color: white;
		border-radius: 50%;
		width: 20px;
		height: 20px;
		text-align: center;
		font-size: 12px;
		line-height: 20px;
	}

	.notification-text {
		position: fixed;
		bottom: 100px;
		right: 100px;
		width: 300px;
		max-height: 60%;
		max-width: 60%;
		overflow-y: auto;
		background-color: #f8f8f8;
		color: #000000;
		border: 1px solid #ccc;
		border-radius: 5px;
		display: none;
		line-height: 1.3;
	}

	/* Estilos para alinear los mensajes del usuario a la derecha y del chatbot a la izquierda */
	.user {
		text-align: right;
	}

	.chatbot {
		text-align: left;
	}

	/* Estilos de la animación de puntos suspensivos */
	@keyframes blink {

		0%,
		100% {
			opacity: 1;
		}

		50% {
			opacity: 0;
		}
	}

	/* Estilos adicionales para los puntos suspensivos */
	.animacion-puntos {
		font-size: 1.5em;
		/* Tamaño de fuente más grande */
		font-weight: bold;
		/* Texto en negrita */
		letter-spacing: 3px;
		/* Espaciado entre letras */
		animation: blink 1s infinite;
	}
</style>
<?php
if (
	isset($_SERVER['HTTPS']) &&
	($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
	isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
	$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
) {
	$protocol = 'https://';
} else {
	$protocol = 'http://';
}
$dominio_general = $protocol . $_SERVER['HTTP_HOST'];
if ($dominio_general === "https://marketplace.imporsuit.com") {
?>
	<script src="https://alfaingenius.com/ws/chatweb/chatweb-v2.js" defer></script>
	<!-- Definición de datos para el chatweb -->
	<script type="text/javascript">
		var data_chatweb_ai = {

			//Datos ChatWeb
			nombre_ai: "IMPORSUIT AI",
			token_ai: "IMPORTSUIT_SUPPORT2023asdJJKALM23489320J",
			id_servicio_mensajeria_ai: "14",
			tokens_respuesta_max_ai: "200", //maximo de tokens
			estado_analytics_chatbot: 0, //si el estado esta 0, no se analiza los mensajes del chatweb
			estado_notificaciones_chatbot: true, //si el modelo esta 0, no se solicita notificaciones

			//Verificar Modo Prueba
			modo_prueba_ai: 0, //si el modo prueba esta 1, no consumira tokens de la IA y solo respondera el mensaje de prueba
			mensaje_de_prueba: 'Para subir un producto en ImportSuit, sigue estos pasos: 1. Inicia sesión en tu cuenta de ImportSuit. 2. Ve al panel de control y selecciona la opción "Productos" en el menú lateral. 3. Haz clic en el botón "Agregar Producto" para crear un nuevo producto. 4. Completa la información requerida para el producto, como el nombre, descripción, categoría, precio, imágenes, etc. 5. Si deseas agregar variantes del producto, como diferentes tamaños o colores, puedes hacerlo en la sección de "Variantes". 6. Si tienes un inventario para el producto, puedes administrarlo en la sección de "Inventario". 7. Una vez que hayas completado todos los detalles del producto, haz clic en el botón "Guardar" para subirlo a tu tienda en línea. Recuerda que puedes consultar la guía detallada sobre cómo agregar productos a tu tienda en ImportSuit en el siguiente enlace: [Agregar Productos a tu Tienda](https://www.notion.so/Agregar-Productos-a-tu-Tienda-be9e714afbe346a9af68b8af462163c4). el tutorial de yotube es: https://www.youtube.com/watch?v=M1IVwWb3vR0&t=4s',

			//parametros ai o prompts

			parametros_chatbot_ai: [{
					"nombre_parametro_chatbot": "home_page",
					"descripcion_parametro_chatbot": "El Cliente se encuentra en la pagina de inicio",
					"prompt_parametro_chatbot": "El Cliente se encuentra en la pagina de inicio",
					"constante_parametro_chatbot": 1,
				},
				{
					"nombre_parametro_chatbot": "estado del e-commerce",
					"descripcion_parametro_chatbot": "El e-commerce esta en estado de prueba",
					"prompt_parametro_chatbot": "El e-commerce esta en estado de prueba",
					"constante_parametro_chatbot": 1,
				},
			],

			//Mensajes Default
			mensajes_default_chatbot_ai: [{
					"mensaje": "Hola! soy tu asistente virtual! en qué deseas que te ayude?",
					"prior": 1, //siempre debe estar activo para que se envie el mensaje
					"onsend": 0, //se envia el mensaje a lo que el usuario envia cualquier mensaje
					"onload": 1, //se envia el mensaje a lo que el usuario recarga la página
					"onfirst": 0, //se envía el mensaje a lo que el usuario
					"opciones_mensaje": [{
							"opcion": "Soporte", //nombre del boton
							"respuesta_mensaje_opcion": "Te ayudaré con Soporte para tu e-commerce, haz cualquier pregunta que necesites",
							"nombre_analytic_chatbot": "soporte_chatweb",
						},
						{
							"opcion": "Manual de Soporte",
							"respuesta_mensaje_opcion": "Te ayudaré con Soporte para tu e-commerce, haz cualquier pregunta que necesites",
							"nombre_analytic_chatbot": "soporte_chatweb",
							"url_mensaje_opcion": "https://google.com",
						},
						{
							"opcion": "Textos para Productos",
							"respuesta_mensaje_opcion": "Te ayudaré a crear textos para productos, pásame el texto del producto para hacerlo vendible",
							"nombre_analytic_chatbot": "marketing_chatweb",
						},
					],

				},
				{
					"mensaje": "Te puedo ayudar en algo mas?",
					"prior": 1, //siempre debe estar activo para que se envie el mensaje
					"onsend": 1, //al enviar cualquier mensaje
					"onload": 0, //al recargar la pagina
					"onfirst": 0, //al enviar por primera vez
					"opciones_mensaje": [{
							"opcion": "Soporte",
							"respuesta_mensaje_opcion": "Te ayudaré con Soporte para tu e-commerce, haz cualquier pregunta que necesites",
							"nombre_analytic_chatbot": "soporte_chatweb",
						},
						{
							"opcion": "Manual de Soporte",
							"respuesta_mensaje_opcion": "Te ayudaré con Soporte para tu e-commerce, haz cualquier pregunta que necesites",
							"nombre_analytic_chatbot": "soporte_chatweb",
							"url_mensaje_opcion": "https://google.com",
						},
						{
							"opcion": "Textos para Productos",
							"respuesta_mensaje_opcion": "Te ayudaré a crear textos para productos, pásame el texto del producto para hacerlo vendible",
							"nombre_analytic_chatbot": "marketing_chatweb",
						},
					],

				},
			],
			mensajes_error_chatbot_ai: "De Momento no puedo atenderte",

			//Analytics Chatweb

			/*
			analytics_chatbots: [
			    "support_notion_api",
			    "cliente_quiere_agendar",
			],
			*/

			//Datos Usuario ChatWeb
			uid_user_ai: "",
			name_user_ai: "Daniel Bonilla",
			celular_user_ai: "593987654321",
			email_user_ai: "cliente@dominio.com",
			datos_usuario_chatbot_ia: [{
					"campo_cliente_chatbot": "tipo de negocio",
					"descripcion_campo_chatbot": "",
					"valor_campo_cliente": "Venta de Autos",
				},
				{
					"campo_cliente_chatbot": "tipo de plan mensual",
					"descripcion_campo_chatbot": "",
					"valor_campo_cliente": "Plan de Prueba",
				},
			],
		};
	</script>

<?php } ?>


</head>


<body class="fixed-left">
</body>

</html>