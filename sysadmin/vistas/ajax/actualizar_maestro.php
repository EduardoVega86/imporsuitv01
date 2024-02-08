<?php

require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos

$verificar_si_existe = "SELECT * FROM users WHERE id_users = '1000' ";
$result = mysqli_query($conexion, $verificar_si_existe);
if (mysqli_num_rows($result) > 0) {
    echo "El usuario ya existe";
    exit;
}

$sql = "INSERT INTO `users` (`id_users`, `nombre_users`, `apellido_users`, `usuario_users`, `con_users`, `email_users`, `tipo_users`, `cargo_users`, `sucursal_users`, `date_added`, `comision_users`, `token_act`, `estado_token`, `fecha_actualizacion`) VALUES (1000, 'SOPORTE', 'SOPORTE', 'v.espinoza', '$2a$12$PbswpN1lnsc1JbGHMBtGnOuiGaTaEjWashETpAnk3iGH1FS2xsmqO', 'v.espinoza@admin.com', '0', '1', '1', '2016-05-21 15:06:00', '1', NULL, NULL, NULL)";
if (mysqli_query($conexion, $sql)) {
    echo "El usuario se ha creado correctamente";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
}
