<?php
//$repositoryPath = 'C:\xampp\htdocs\imporsuitv01'; // Reemplaza con la ruta de tu repositorio
require_once "db.php";
    require_once "php_conexion.php";
   // require_once "sysadmin/vistas/funciones.php";
    
    // Consulta para verificar la existencia del campo
    
//29-10-2023 aumentar campo id_articulo en testimonios
$query = "SELECT id_producto FROM testimonios LIMIT 1";
$result = mysqli_fetch_array($query);
if (!$result) {
    
    
    $query = mysqli_query($conexion, "ALTER TABLE `testimonios` ADD `id_producto` INT NOT NULL AFTER `date_added`;");
   
} 


?>


