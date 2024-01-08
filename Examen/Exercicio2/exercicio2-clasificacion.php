<html>
<head>
<title>Exercicio2 resultados</title>
</head>
<body>
    <?php
    
        session_start();
        $conexion=mysqli_connect("localhost","root","","clasificacion");


        $equipos = file("equipos.txt");
        $arrayEquipos = array($equipos);

        echo "<table border=1>";
        echo "<tr><th>Equipo</th><th>Puntos</th></tr>";
        
        
        foreach($arrayEquipos as $equipo){
            $sqlNombre="SELECT equipoLocal AS nombre, (golesLocal-golesVisitante)>0, SUM(0+3) AS puntos FROM clasificacion WHERE equipoLocal='$equipo[0]' OR golesVisitante='$equipo[0]'";
            $result = $conexion->query($sqlNombre);
            if ($result->num_rows > 0) {
                echo "<table border=1>";
                echo "<tr><th>Equipo</th><th>Puntos</th></tr>";
                echo "<tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["puntos"] . "</td>";
                }
                echo "</tr>";
            }

        }
        echo "</table>";



    ?>
</body>
</html>