<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 4</title>

</head>
<body>

   <?php
       
    $ciudades = array(
        "Palencia" => 8000,
        "Valladolid" => 306000,
        "Murcia" =>439000,
        "Albacete" => 170000,
        "Barcelona" => 160000,
        "A Coruña" =>25000
    );

    $materiales = array(
        "Au" => "Oro",
        "Ag" => "Plata",
        "Hg" => "Mercurio",
        "H" => "Hidrógeno"
    );

    function DebuxarArrai($ciudades){
        echo "<table border=1>";
        echo "\t<tr style='background-color:black; color: white'>";
        echo "\t\t<th>Índices</th><th>Valores</th>";
        echo "\t</tr>";
        foreach($ciudades as $nombre => $valor){
            echo "\t<tr>";
            echo "\t<td style='background-color:lightgrey'>" . $nombre . "</td><td>" . $valor . "</td>";
            echo "\t</tr>";
        }
    }

    DebuxarArrai($ciudades);

    DebuxarArrai($materiales);
   ?>
    
</body>
</html>