<?php
    $conexion=mysqli_connect("localhost","root","","pregunta1");

    $sql="SELECT * FROM categorias";
    $result = $conexion->query($sq);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            
        }
    }
?>