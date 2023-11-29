<?php
    $haypreferencias=true;
   if(!isset($_COOKIE["nome"]) || !isset($_COOKIE["apelidos"]) || !isset($_COOKIE["colorFondo"]) || !isset($_COOKIE["colorLetra"]) || !isset($_COOKIE["tipoLetra"])){
        if(!isset($_POST["nome"]) || !isset($_POST["apelidos"]) || !isset($_POST["colorFondo"]) || !isset($_POST["colorLetra"]) || !isset($_POST["tipoLetra"])){
            $haypreferencias=false;
        } else {
            $nome=$_POST["nome"];
            $apelidos=$_POST["apelidos"];
            $colorFondo=$_POST["colorFondo"];
            $colorLetra=$_POST["colorLetra"];
            $tipoLetra=$_POST["tipoLetra"];
        }
    } else {
        $nome=$_COOKIE["nome"];
        $apelidos=$_COOKIE["apelidos"];
        $colorFondo=$_COOKIE["colorFondo"];
        $colorLetra=$_COOKIE["colorLetra"];
        $tipoLetra=$_COOKIE["tipoLetra"];
    }

    if($haypreferencias==false){
        header("Location: practica1_index.php");
    } else {
        setcookie("nome" , $nome , time() + (24*60*60));
        setcookie("apelidos" , $apelidos , time() + (24*60*60));
        setcookie("colorFondo", $colorFondo, time() + (24*60*60));
        setcookie("colorLetra", $colorLetra, time() + (24*60*60),);
        setcookie("tipoLetra", $tipoLetra, time() + (24*60*60));
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
   <p><a href="practica1_borrar.php">Volver o inicio</a></p>
</body>
</html>