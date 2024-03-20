<?php
    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("Location: inicioSesion.php");
        exit;
    }
    
    $conexion = mysqli_connect("localhost", "root", "", "supermercado");
    error_reporting(E_ALL ^ E_WARNING);

    if(isset($_POST["codcat"])){
        
    } else if (isset($_POST["codprod"])){

    }
?>