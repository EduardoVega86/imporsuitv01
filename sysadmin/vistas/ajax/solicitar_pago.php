<?php
$data = file_get_contents("php://input");

parse_str($data, $datos);

$tienda = $datos['tienda'];
$cantidad = $datos['dinero'];

if ($cantidad == 0 || $cantidad == "") {
    echo "dinero";
    exit();
}

$marketplace_query_url = 'imporsuit_marketplace';
$marketplace_conexionquery = mysqli_connect('localhost', $marketplace_query_url, $marketplace_query_url, $marketplace_query_url);

$query_total_ventas = "SELECT SUM(valor_pendiente) AS total_pendiente_a_la_tienda FROM cabecera_cuenta_pagar WHERE tienda = '$tienda'";

$resultado_total_ventas = mysqli_query($marketplace_conexionquery, $query_total_ventas);
$datos_total_ventas = mysqli_fetch_assoc($resultado_total_ventas);



$total_pendiente_a_la_tienda = $datos_total_ventas['total_pendiente_a_la_tienda'];

if ($cantidad > $total_pendiente_a_la_tienda) {
    echo "mayor";
    exit();
}


// Gestionar mensaje con phpmailer
require_once '../../PHPMailer/PHPMailer.php';
require_once '../../PHPMailer/SMTP.php';
require_once '../../PHPMailer/Exception.php';
include '../../PHPMailer/Mail_Pago.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$correo = "SELECT * FROM datos_banco_usuarios WHERE tienda = '$tienda'";
$resultado_correo = mysqli_query($marketplace_conexionquery, $correo);
$datos_correo = mysqli_fetch_assoc($resultado_correo);

$correo = $datos_correo['correo'];
$nombre = $datos_correo['nombre'];
$banco = $datos_correo['banco'];
$tipo_cuenta = $datos_correo['tipo_cuenta'];
$numero_cuenta = $datos_correo['numero_cuenta'];
$cedula = $datos_correo['cedula'];
$telefono = $datos_correo['telefono'];



$mail = new PHPMailer(true);

$mensaje = '';

try {
    //Server settings

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = $smtp_debug;
    $mail->Host = $smtp_host;
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_user;
    $mail->Password = $smtp_pass;
    $mail->Port = 465;
    $mail->SMTPSecure = $smtp_secure;

    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->setFrom($smtp_from, $smtp_from_name);
    $mail->addAddress('desarrollo1@imporfactoryusa.com');
    $mail->Subject = 'Solicitud de pago ' . $tienda;
    $mail->Body = $message_body;

    if ($mail->send()) {
        echo "enviado";
    } else {
        echo $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

// Fin de la gestión de phpmailer