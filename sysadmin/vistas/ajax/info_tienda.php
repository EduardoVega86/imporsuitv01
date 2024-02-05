<?php

$get_datos = json_decode(file_get_contents('php://input'), true);

echo "Datos: ";
print_r($get_datos);
echo "<br>";
