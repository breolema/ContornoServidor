<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 1</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

</head>
<body>
    <h1>Táboa de Multiplicar</h1>
    <form method="post">
        <p>Número  <input type="number" name="numero">  <input type="submit" value="Xerar Taboa"></p>
    </form>
   <?php
   $numero=$_POST["numero"];

    echo "<h2>Tabla de multiplicar do $numero:</h2>";
    echo "<table class='table'>";
    echo "<tr>";
    echo "<th>Número</th>";
    echo "<th></th>";
    echo "<th></th>";
    echo "<th></th>";
    echo "<th>Resultado</th>";
    echo "</tr>";
   for($i=1;$i<=10;$i++){
        echo "<tr>";
        echo "<td>$numero</td>";
        echo "<td>x</td>";
        echo "<td>$i</td>";
        echo "<td>=</td>";
        echo "<td>". ($numero*$i) ."</td>";
        echo "</tr>";
   }
   echo "</table>";
   ?>
    
</body>
</html>