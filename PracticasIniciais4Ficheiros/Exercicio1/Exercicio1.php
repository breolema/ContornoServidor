<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 1</title>
</head>
<body>
    <h1>Bar Baio</h1>
    <form action="visitantes.php" method="post">
    <p>Nome*:  <input type="text" name="nome"></p>
    <p>Mail: <input type="text" name="mail"></p>
    <p>Mensaxe: <br><textarea type="text" name="mensaxe" rows="4" cols="50"></textarea></p>
    <p><input type="submit" value="Enviar"> <input type="reset" value="Borrar"></p>
    </form>
    <hr>
    <h1>Mensaxes deixados polos usuarios</h1>
    <hr>

    <?php
        if(file_exists("visitantes.txt")){
            $file="visitantes.txt";
            if(!$file=fopen($file,"r")){
                echo "No hai reseñas";
            } else{
                if(filesize("visitantes.txt")>0){
                    $contenido= fread($file, filesize("visitantes.txt"));
                    $lineas=explode("-",$contenido);

            krsort($lineas);

            echo "<table>";

            foreach($lineas as $linea){
                echo "<tr>";
                echo "<td>" . $linea . "</td>";
                echo "</tr>";
            }
            echo "</table>";
                } else {
                    echo "<strong>No hai reseñas</strong>";
                }
                fclose($file);
        }
        } else {
            echo "Todavia non hai reseñas";
        }
        
    ?>
    
</body>
</html>