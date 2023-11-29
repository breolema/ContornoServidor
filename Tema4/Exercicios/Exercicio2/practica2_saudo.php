<?php
session_start();
    $haypreferencias=true;
   if(!isset($_SESSION["nome"]) || !isset($_SESSION["apelidos"]) || !isset($_SESSION["colorFondo"]) || !isset($_SESSION["colorLetra"]) || !isset($_SESSION["tipoLetra"])){
        if(!isset($_POST["nome"]) || !isset($_POST["apelidos"]) || !isset($_POST["colorFondo"]) || !isset($_POST["colorLetra"]) || !isset($_POST["tipoLetra"])){
           $haypreferencias=false;
        } else {
            $_SESSION["nome"] = $_POST["nome"];
            $_SESSION["apelidos"] = $_POST["apelidos"];
            $_SESSION["colorFondo"] = $_POST["colorFondo"];
            $_SESSION["colorLetra"] = $_POST["colorLetra"];
            $_SESSION["tipoLetra"] = $_POST["tipoLetra"];
        }
    }
        $nome = $_SESSION["nome"];
        $apelidos = $_SESSION["apelidos"];
        $colorFondo = $_SESSION["colorFondo"];
        $colorLetra = $_SESSION["colorLetra"];
        $tipoLetra = $_SESSION["tipoLetra"];

    if($haypreferencias==false){
        header("Location: practica2_index.php");
    }
   
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Saudo</title>
    <style>
        body{
            background-color: <?=$colorFondo ?>;
            color: <?=$colorLetra ?>;
            font-family:  <?=$tipoLetra ?>;
        }

        a{
            background-color:white;
        }
    </style>
</head>
<body>
   <h2>Benvido <?= "$nome $apelidos" ?></h2>
   <p><a href="practica2_borrar.php">Volver o inicio</a></p>
</body>
</html>