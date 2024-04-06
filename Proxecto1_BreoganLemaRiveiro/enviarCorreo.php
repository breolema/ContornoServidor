<?php
include_once("conexionbd.php");


require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();
$mail->IsSMTP();

$codUsuario = $_GET['codUsuario'];
$codPedido = $_GET['codPedido'];

$sqlCorrUser = "SELECT Correo FROM usuarios WHERE CodUsu=$codUsuario";
$resultCorrUser = $conexion->query($sqlCorrUser);

if ($resultCorrUser->num_rows > 0) {
    while ($fila = $resultCorrUser->fetch_assoc()) {
        $emailCliente = $fila["Correo"];
    }
}

//Configuracion servidor mail
$mail->From = "breolema13@gmail.com"; //indicar o email do remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; //seguridad
$mail->Host = "smtp.gmail.com"; // servidor smtp
$mail->Port = 587; //puerto
$mail->Username = 'breolema13@gmail.com'; //nombre usuario
$mail->Password = 'otqc buno oolz fdgi'; //contraseña xerada automaticamente dende a conta de google
$mail->Subject = 'Su pedido ha sido recibido';

//Agregar destinatario
$mail->AddAddress($emailCliente);
$mail->Body = 'Su pedido con nº ' . $codPedido . ' ha sido realizado  y esta en preparacion';

$mail->Send();
header("Location: inicio.php");
?>