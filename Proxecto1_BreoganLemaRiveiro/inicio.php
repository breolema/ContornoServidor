<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: inicioSesion.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="css/estilos_PaxInicio.css">
    <link rel="stylesheet" href="css/comunTodos.css">
    <link rel="icon" type="image/jpg" href="imagenes/icono.png" />

<body>

    <nav>
        <img src="imagenes/icono.png" alt="logo">
        <a href="inicio.php">Inicio</a>
        <a href="paginaCategorias.php">Categorias</a>
        <a href="misPedidos.php">Mis Pedidos</a>
        <a href="informacion.php">Información</a>
        <div id="logout">
            <a href="logout.php"><img src="imagenes/logout.png"></a>
            <a href="carrito.php"><img src="imagenes/carrito.png"></a>
        </div>
    </nav>
    <section class="tarjeta-registro">
        <h2>¡Consigue tu tarjeta y tendrás más ventajas!</h2>
        <ul>
            <li>Promociones exclusivas</li>
            <li>Vales ahorro personalizados</li>
            <li>La app con todas las ventajas en tu bolsillo</li>
            <li>Te escuchamos: Tu opinión cuenta</li>
            <li>Y además, viajes y regalos ...</li>
        </ul>
    </section>
    <br><br>
    <img src="imagenes/super.jpeg" alt="supermercado" height="70%">
</body>

</html>