<?php
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body{
            background-color: #fce4c6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form{
            background-color: #1E1E1E;
            width: 300px;
            padding: 20px;
            border-radius: 10px;
        }

        .boton{
            background-color: #fce4c6;
            color: #1E1E1E;
            padding: 10px 50px;
            margin-top: 20px;
            border-radius: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
        }

        h1{
            font-size: 60px;
            color: #1E1E1E;
        }

        h2{
            margin-bottom: 35px;
            margin-top: -5px;
            color: #fce4c6;
        }

        p{
            font-size: 17px;
            margin-bottom: 0.01px;
            color: #fce4c6;
        }


    </style>
</head>
<body>
    <center>
        <h1>Supermercados Lema</h1>

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