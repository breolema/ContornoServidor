<?php
session_start();
if(isset($_SESSION["apuesta"]) && isset($_SESSION["partidos"])){
    header("Location: exercicio2-resultados.php");
}    
?>

<html>
<head>
<title>Exercicio2 index</title>
</head>
<body>
        <?php
            $equipos = file("equipos.txt");

            shuffle($equipos);
            $arrayEquipos = array_chunk($equipos, 2);
            
            echo "<form action='exercicio2-resultados.php?partidos=" . serialize($arrayEquipos) . " method='POST'>";
            $i=0;
            foreach ($arrayEquipos as $partido) {
            echo "<p>";
            echo $partido[0] . " - " . $partido[1];
            echo "<input type='radio' name='apuesta[" . $partido[0] . "]' value='1'> 1";
            echo "<input type='radio' name='apuesta[" . $partido[0] . "]' value='2'> X";
            echo "<input type='radio' name='apuesta[" . $partido[0] . "]' value='3'> 2";
            echo "</p>";
            }
                
            echo "<input type='button' value='Generar aleatoriamente'>";
            echo "<input type='submit' value='Enviar pronosticos'>";
            echo "<a href='exercicio2-index.php'><input type='button' value='Generar aleatoriamente' id='alearorio'></a>";
            echo "<a href='exercicio2-borrarSesion.php'><input type='button' value='Cerrar sesion'></a>";
            echo "</form>";
        ?>
            
    </form>
</body>
</html>
