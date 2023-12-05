<?php
     $conexion=mysqli_connect("localhost","root","","cursos");

     $sqlCursos="SELECT id_curso,curso,plazas_totales,plazas_ocupadas,plazas_totales-plazas_ocupadas AS plazas_disponibles FROM cursos";
     $result = $conexion->query($sqlCursos);
?>

<html>
<head>
<title>Exercicio6-index</title>
<style>
    .tachado{
        text-decoration: line-through;
        background-color: red;
    }

    .ocupado{
        background-color: lightgreen;
    }

</style>
</head>
<body>
    <h1>Lista de cursos</h1>

    <?php

         if ($result->num_rows > 0) {
            echo "<table border=1>";
            echo "<tr><th>Cursos dispoñibles</th><th>Plazas totales</th><th>Plazas disponibles</th><th>Dar de alta</th><th>Dar de baixa</th></tr>";
            while($row = $result->fetch_assoc()) {

                $tachado="";
                $ocupado="";

                if ($row["plazas_disponibles"]==0){
                    $tachado="class='tachado'";
                }

                if ($row["plazas_disponibles"]==$row["plazas_totales"]){
                    $ocupado="class='ocupado'";
                }

                echo "<tr><td $tachado $ocupado>" . $row["curso"] . "</td>";
                echo "<td $tachado $ocupado>" . $row["plazas_totales"] . "</td>";
                echo "<td $tachado $ocupado>" . $row["plazas_disponibles"] . "</td>";
                echo "<td>";
                if(!$tachado){
                    echo "<a href='Exercicio6-añadir.php?id=" .  $row["id_curso"] . " '>Añadir plaza</a>";
                }
                echo "</td>";

                echo "<td>";
                if(!$ocupado){
                    echo "<a href='Exercicio6-darDeBaixa.php?id=" .  $row["id_curso"] . " '>Dar plaza de baixa</a></td>";
                }
                echo "</td>";


                echo "</tr>";
            }
            echo "</table>";
        }

                $sqlPlazasOfertadas="SELECT SUM(plazas_totales-plazas_ocupadas) AS plazasTotalesOcupadas FROM cursos";
                $resultPlazasOfertadas = $conexion->query($sqlPlazasOfertadas);
                $sqlPlazasOcupadas="SELECT SUM(plazas_ocupadas) AS plazasOcupadas FROM cursos";
                $resultPlazasOcupadas = $conexion->query($sqlPlazasOcupadas);

                $sqlPorcentaje="SELECT (SUM(plazas_totales-plazas_ocupadas)/SUM(plazas_totales)) as porcentajeOcupacion FROM cursos";
                $resultPorcentaje = $conexion->query($sqlPorcentaje);
    
    ?>

    <h2>Resumen de ocupacion:</h2> 
    <ul>
        <li>Plazas totales ofertadas: 
            <?php   
                 if ($resultPlazasOfertadas->num_rows > 0) {
                    while($row = $resultPlazasOfertadas->fetch_assoc()) {
                        echo $row["plazasTotalesOcupadas"];
                    }
                 }
            ?></li>
        <li>Plazas ocupadas: 
        <?php   
                 if ($resultPlazasOcupadas->num_rows > 0) {
                    while($row = $resultPlazasOcupadas->fetch_assoc()) {
                        echo $row["plazasOcupadas"];
                    }
                 }
            ?>
        </li>

        <li>Porcentaje de ocupación: 
            <?php 
                if ($resultPorcentaje->num_rows > 0) {
                    while($row = $resultPorcentaje->fetch_assoc()) {
                        echo $row["porcentajeOcupacion"];
                    }
                }
            ?>%</li>
    </ul>

</body>
</html>