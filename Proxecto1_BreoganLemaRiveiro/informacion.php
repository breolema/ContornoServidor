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

    <h1>Información sobre o supermercado</h1>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2911.1112889401466!2d-8.958744423465866!3d43.14419228520273!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd2eb88b0f2c0019%3A0xa55170088a0847f3!2s%5BIES%5D%20Instituto%20de%20Educaci%C3%B3n%20Secundaria%20Maximino%20Romero%20de%20Lema!5e0!3m2!1ses!2ses!4v1700818392686!5m2!1ses!2ses"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    <p class="parrafo">Horario de atención al público: Lunes a Viernes de 10:00 a 21:00 horas <br>
    y Sabados de 9:00 a 17:00
        <br>
        Prado da Torre s/n 15150 - Baio (Zas)
        <br>
        Teléfono: 881 960 015
    </p>
    
</body>

</html>