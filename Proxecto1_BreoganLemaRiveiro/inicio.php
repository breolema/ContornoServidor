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
<body>
    
    <nav>
        <img src="imagenes/icono.png" alt="logo">
        <a href="inicio.php">Inicio</a>
        <a href="paginaCategorias.php">Categorias</a>
        <a href="">Ofertas</a>
        <a href="">Información</a>
        <div  id="logout">
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
</body>

</html>