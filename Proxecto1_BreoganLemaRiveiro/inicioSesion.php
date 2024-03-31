<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="css/estilos_Login.css">
    <link rel="icon" type="image/jpg" href="imagenes/icono.png" />
</head>

<body>
    <center>
        <h1>Supermercados Lema</h1>

        <!--Formulario comprobacion do usuario na base de datos-->
        <form action="login.php" method="POST">
            <h2>Inicio de sesion</h2>
            <p>Usuario</p>
            <input type="text" name="usuario" placeholder="Nombre de usuario"><br>
            <p>Contraseña</p>
            <input type="password" name="clave" placeholder="Contraseña"><br>
            <input type="submit" value="Entrar" class="boton">
    </center>
    </form>
</body>

</html>