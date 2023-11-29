<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Rexistro de notas</title>
</head>
<body>
    <?php
        if(file_exists("notas.txt")){
            $file="notas.txt";
            if(!$file=fopen($file,"r")){
                echo "Non hai notas";
            }else {
                if(filesize("notas.txt")>0){
                    $contenido= fread($file, filesize("notas.txt"));
                    $lineas=explode("$",$contenido);

                    krsort($lineas);

                    foreach($lineas as $linea){
                        echo "$linea";
                    }
                } else {
                    echo "Non hai notas todavia.";
                }
                fclose($file);
            }
        } else {
            echo "Non hai ningún archivo.";
        }

    ?>
    
</body>
</html>