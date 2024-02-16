<?php
$imagen = "https://marketplace.imporsuit.com/sysadmin/img/speed.jpg";
$imagen_url = file_get_contents($imagen);

echo $imagen_url;
