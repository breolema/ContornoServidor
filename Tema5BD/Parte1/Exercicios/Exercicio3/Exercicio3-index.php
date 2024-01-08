<?php
session_start(); 
?>

<html>
<head>
<title>Exercicio3-index</title>
<style>
    body{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        margin: 0;
    }
    .container{
        display: flex;
        justify-content: space-between;
        width: 900px;
        margin: auto;
        padding: 200px;
    }

    
</style>
</head>
<body>

    <div class="container">
        <form action="Exercicio3-login.php" method="GET">
            <h3>Entrar en la cuenta</h3><br>
            <input type="text" name="usuario" placeholder="usuario"><br>
            <input type="password" name="contr" placeholder="contrasena"><br>
            <input type="submit" value="Validar">
        </form>
    </div>

    <div class="container">
        <form action="Exercicio3-nuevo.php" method="GET">
                <h3>Nuevo usuario</h3>
                <input type="text" name="userNuevo" placeholder="usuario"><br>
                <input type="password" name="contrNueva" placeholder="contrasena"><br>
                <input type="password" name="contrNuevaRepetir" placeholder="repita la contrasena"><br>
            <input type="submit" value="Alta de usuario">
        </form>
    </div>

</body>
</html>
