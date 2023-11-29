<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 8</title>
</head>
<body>

    <form action="Exercicio8.php" method="get">
        <p>Escriba un numero entero: <input type="number" name="numero"></p>
        <p><input type="submit" value="Calcular"></p>
    </form>

   <?php
       if(isset($_GET["numero"])){
        $numero = $_GET['numero'];
        $sumaPares = 0;
        
        for ($i = 2; $i < $numero; $i = $i+2) {
            $sumaPares += $i;
        }
        echo "La suma es: $sumaPares";
             } else {
        echo "No se ha proporcionado un número válido.";
    }
    ?>

</body>
</html>