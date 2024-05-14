<?php

/*-------------------------
Autor: duardo VEga
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
require_once "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Categorias";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
//Archivo de funciones PHP
require_once "../funciones.php";
// Consulta SQL para obtener las opciones del select desde la tabla 'variedades'
//$id_atributo = $_GET['id_atributo']; // Suponiendo que 'id_atributo' se pasa como parámetro en la URL
$sql = "SELECT * FROM bodega";
//$result = $conexion->query($sql);
    $query = mysqli_query($conexion, $sql);
$options = array();

// Si se encuentran filas en el resultado
 while ($row = mysqli_fetch_array($query)) {

        $option = array(
            'valor' => $row['id'],
            'etiqueta' => $row['nombre']
        );
        array_push($options, $option);
    }

// Cerrar la conexión a la base de datos
$conexion->close();

// Devolver las opciones en formato JSON
header('Content-Type: application/json');
echo json_encode($options);

?>