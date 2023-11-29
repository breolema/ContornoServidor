<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 2</title>

</head>
<body>
<h2>Clasificación de La Liga 2021</h2>
   <?php
           $equipos = array(
            "Real Madrid" => 84,
            "Barcelona" => 79,
            "Sevilla" => 77,
            "Real Sociedad" => 62,
            "Betis" => 61,
            "Atletico de Madrid" => 86,
            "Levante" => 41,
            "Getafe" => 38,
            "Alaves" => 38,
            "Villarreal" => 58,
            "Celta" => 53,
            "Granada" => 46,
            "Athletic" => 46,
            "Osasuna" => 44,
            "Elche" => 36,
            "Huesca" => 34,
            "Valladolid" => 31,
            "Cadiz" => 44,
            "Valencia" => 43,
            "Eibar" => 30
        );

        arsort($equipos);

        if (isset($_POST['equipo'])) {
            $equipoSeleccionado = $_POST['equipo'];
            $posicion = array_search($equipoSeleccionado, array_keys($equipos)) + 1;
            $puntosAux = $equipos[$equipoSeleccionado];
        } else {
            echo "<p>No se ha seleccionado ningun equipo</p>";
        }
    ?>
    <form method="post" action="Exercicio2.php">
        <label for="equipo">Selecciona un equipo:</label>
        <select name="equipo" id="equipo">
    <?php
    
         foreach ($equipos as $equipo => $puntos) {
            echo "<option value='$equipo'>$equipo</option>";
        }
    ?>
    </select>
    <input type="submit" value="Comprobar"/>
    </form>
    <?php
    echo "<p>El equipo es $equipoSeleccionado tiene $puntosAux y esta $posicion º en la liga</p>";
    ?>
    

</body>
</html>