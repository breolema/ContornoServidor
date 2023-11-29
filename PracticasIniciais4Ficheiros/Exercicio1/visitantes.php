<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 1</title>
</head>
<body>
    <?php
    //print "<pre>";
    //print_r ($_POST);
    //print "</pre>";
        $file=fopen("visitantes.txt" , "a");
        $nom=($_POST['nome']);
        $mail=($_POST['mail']);
        $mensaxe=stripslashes(nl2br(htmlentities($_POST['mensaxe'])));
        $d = date ("d/m/Y H:i:s");
        $page = " ";
        $lerMail="<a href=\"mailto:$mail\">$mail</a>";

        $page .="<b>$nom </b>(" . $lerMail .") <b>Fecha: </b>$d <br> <b>Mensaje: </b> $mensaxe\n<br><hr>-";
      
        fwrite($file,"$page",strlen("$page"));     

        fclose($file);

        echo "Gracias pola tua reseña! <br>";
        echo "<a href='Exercicio1.php'>Volver a páxina principal</a>";

    ?>
    
</body>
</html>