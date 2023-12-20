<?php

$data = file_get_contents('php://input');
parse_str($data, $output);

print_r($output);
