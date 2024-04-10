<?php
session_start();

if (!isset($_SESSION["usuarioadmin"])) {
    header("Location: inicioSesion.php");
    exit;
}

include_once("conexionbd.php");

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Alta clientes</title>

    <link rel="stylesheet" href="css/estilos_Logs.css">
    <link rel="stylesheet" href="css/comunTodos.css">
    <link rel="icon" type="image/jpg" href="imagenes/icono.png" />

</head>

<body>
    <nav>
        <img src="imagenes/icono.png" alt="logo" />
        <a href="todosPedidos.php">Pedidos</a>
        <a href="darAltaUsuarios.php">Alta usuarios</a>
        <a href="categoriasAdmin.php">Modificar categorias</a>
        <a href="productosAdmin.php">Modificar productos</a>
        <a href="historialMod.php">Historial Modificaciones</a>
        <div id="logout">
            <a href="logout.php"><img src="imagenes/logout.png"></a>
        </div>
    </nav>

    <?php
    $sqlLog = "SELECT * FROM historialmodificaciones";
    $resultLog = $conexion->query($sqlLog);

    if ($resultLog->num_rows > 0) {
        echo "<table border=1>";
        echo "<tr>";
        echo  "<th>Usuario</th><th>Descripción</th><th>Fecha</th>";
        echo "</tr>";
        while ($fila = $resultLog->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['CodUsuario'] . "</td>";
            echo "<td>" . $fila['Descripcion'] . "</td>";
            echo "<td>" . $fila['Fecha'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>A tabla de modificacions non ten datos</p>";
    }
    ?>

</body>

</html>