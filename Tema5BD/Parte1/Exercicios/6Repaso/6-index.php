<?php
    $conexion=mysqli_connect("localhost","root","","cursos");
    $sqlCursos="SELECT id_curso,curso,plazas_totales,(plazas_totales-plazas_ocupadas) AS plazas_disponibles FROM cursos";
    $result = $conexion->query($sqlCursos);
?>

<html>
<head>
<title>Exercicio6</title>
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
            echo "<tr><td>Cursos disponibles</td><td>Plazas totales</td><td>Plazas disponibles</td><th>Dar de alta</th><th>Dar de baixa</th></tr>";
            while($row = $result->fetch_assoc()) {

                $tachado="";
                $ocupado="";
                
            if ($row["plazas_disponibles"]==0){
                $tachado="class='tachado'";
            }

            if ($row["plazas_disponibles"]==$row["plazas_totales"]){
                $ocupado="class='ocupado'";
            }

                echo "<tr>";
                echo "<td $tachado $ocupado>" . $row["curso"] . "</td>";
                echo "<td $tachado $ocupado>" . $row["plazas_totales"] . "</td>";
                echo "<td $tachado $ocupado>" . $row["plazas_disponibles"] . "</td>";
                if(!$tachado){
                    echo "<a href='6-anadir.php?id=" .  $row["id_curso"] . " '>Añadir plaza</a>";
                }
                if(!$ocupado){
                    echo "<a href='6-borrar.php?id=" .  $row["id_curso"] . " '>Dar de baixa plaza</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    
    ?>

</body>
</html>