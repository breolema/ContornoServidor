<html>
<head>
<title>Exercicio2 resultados</title>
</head>
<body>
    <?php
    
    session_start();

        $conexion=mysqli_connect("localhost","root","","clasificacion");

            $equipos = file("equipos.txt");

            shuffle($equipos);
            $arrayEquipos = array_chunk($equipos, 2);
            
            echo "<form action='exercicio2-resultados.php?partidos=" . serialize($arrayEquipos) . " method='POST'>";

           

             echo "<table border=1>";
             echo "<tr><th>Equipo local</th><th>Resultado</th><th>Equipo visitante</th><th>Goles</th></tr>";
             foreach($arrayEquipos as $partido){
                $numero1=rand(0,5);
                $numero2=rand(0,5);
                echo "<tr>";
                echo "<td>" . $partido[0] . "</td>";
                if($numero1>$numero2){
                    echo "<td>1</td>";
                } else if ($numero1==$numero2){
                    echo "<td>X</td>";
                } else {
                    echo "<td>2</td>";
                }
                echo "<td>" . $partido[1] . "</td>";
                echo "<td>" . $numero1 . "-" . $numero2 . "</td>";
                echo "</tr>";
                
                $sql="INSERT INTO clasificacion  (equipoLocal,equipoVisitante,golesLocal,golesVisitante) VALUES( '$partido[0]' ,  '$partido[1]' , $numero1,$numero2);";
                $result = $conexion->query($sql);
             }
             echo "</table>";
             
                        
    ?>
    
</body>
</html>
