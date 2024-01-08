<?php
    session_start();
    $conexion=mysqli_connect("localhost","root","","clasificacion");

   unset($_SESSION);
   session_destroy();

    $sql="UPDATE equipos SET puntos=0";
    $result = $conexion->query($sql);

    header("Location: exercicio2-index.php");
?>