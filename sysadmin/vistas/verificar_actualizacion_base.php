<?php
//$repositoryPath = 'C:\xampp\htdocs\imporsuitv01'; // Reemplaza con la ruta de tu repositorio
require_once "vistas/db.php";
    require_once "vistas/php_conexion.php";
   // require_once "sysadmin/vistas/funciones.php";
    
    // Consulta para verificar la existencia del campo
    
//29-10-2023 aumentar campo id_articulo en testimonios
$query = "SELECT id_producto FROM testimonios LIMIT 1";
$result = mysqli_fetch_array($query);
if (!$result) {
    $sql_actualizacion = "ALTER TABLE `testimonios` ADD `id_producto` INT NOT NULL AFTER `date_added`;";
    $result = mysqli_fetch_array($sql_actualizacion);
} 

    
?>


