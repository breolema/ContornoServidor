<?php
    if(isset($_COOKIE["nome"]) && isset($_COOKIE["apelidos"]) && isset($_COOKIE["colorFondo"]) && isset($_COOKIE["colorLetra"]) && isset($_COOKIE["tipoLetra"])){
        header("Location: practica1_saudo.php");
    }    
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Index</title>
</head>
<body>
<h1>Practica 1</h1>
    <form method="post" action="practica1_saudo.php">
        <p>Nome: <input type="text" name="nome"></p>
        <p>Apelidos: <input type="text" name="apelidos"></p>
        <p>Color de fondo: <input type="color" name="colorFondo"/></p>
        <p>Color de letra: <input type="color" name="colorLetra"/></p>
        <select name="tipoLetra">
            <option value="Arial">Arial</option>
            <option value="Verdana">Verdana</option>
            <option value="Helvetica">Helvetica</option>
        </select><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>