<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}

$conexion = mysqli_connect("localhost", "root", "", "supermercado");

$codEstadoPedido = $_POST["nuevoEstado"];
$codigoPedido = $_POST["codigoPedido"];

if (isset($_POST["codigoPedido"]) && isset($_POST["nuevoEstado"])) {
    $codEstadoPedido = $_POST["nuevoEstado"];
    $codigoPedido = $_POST["codigoPedido"];

    $updateEstado = "UPDATE pedidos SET CodEstado = '$codEstadoPedido' WHERE CodPed = $codigoPedido";
    $resultUpdate = $conexion->query($updateEstado);
    header("Location: todosPedidos.php");
}


?>