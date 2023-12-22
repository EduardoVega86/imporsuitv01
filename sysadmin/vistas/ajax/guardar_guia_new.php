<?php

$data = file_get_contents("php://input");
parse_str($data, $datos);

print_r($datos);
