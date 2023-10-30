<?php
//$repositoryPath = 'C:\xampp\htdocs\imporsuitv01'; // Reemplaza con la ruta de tu repositorio
require_once "vistas/db.php";
    require_once "vistas/php_conexion.php";
   // require_once "sysadmin/vistas/funciones.php";
    
    // Consulta para verificar la existencia del campo
    
//29-10-2023 aumentar campo id_articulo en testimonios
$query = "SELECT $campoABuscar FROM tu_tabla LIMIT 1";
$result = $conn->query($query);
if (!$result) {
    $sql_actualizacion = "ALTER TABLE `testimonios` ADD `id_producto` INT NOT NULL AFTER `date_added`;";
    $result = $conn->query($query);
} 

    
?>


