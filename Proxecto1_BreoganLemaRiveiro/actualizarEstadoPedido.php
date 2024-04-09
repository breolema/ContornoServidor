<?php
session_start();
include_once("conexionbd.php");

if (!isset($_SESSION["usuarioadmin"])) {
    header("Location: inicioSesion.php");
    exit;
}

//comprobamos si se enviou algo
if (isset($_POST["codigoPedido"]) && isset($_POST["nuevoEstado"])) {
    //añadimolos a variables
    $codEstadoPedido = $_POST["nuevoEstado"];
    $codigoPedido = $_POST["codigoPedido"];

    //facemos o update na base de datos
    $updateEstado = "UPDATE pedidos SET CodEstado = '$codEstadoPedido' WHERE CodPed = $codigoPedido";
    $resultUpdate = $conexion->query($updateEstado);
    header("Location: todosPedidos.php");
}


?>