<?php
$data = file_get_contents("php://input");
if (!empty($data)) {
    file_put_contents('../json/checkout.json', $data);
    echo "Data saved successfully";
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "No data received";
}
?>