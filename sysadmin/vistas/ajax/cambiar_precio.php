<?php

$data = file_get_contents("php://input");
$data = json_decode($data, true);

print_r($data);
