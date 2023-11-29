<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title>Buscar por Nota</title>
</head>
<body>
    <h1>Busca unha nota asociada a un DNI</h1>
    <form method="post">
        <p>DNI: <input type="text" name="buscarDNI"></p>
        <p><input type="submit" value="Buscar"></p>
    </form>
    <p><a href="Exercicio2.php">Volver al registro de notas</a></p>
    <?php
        if (isset($_POST['buscarDNI'])) {
            $archivo = "notas.txt";
            $buscarDNI = $_POST['buscarDNI'];
            $lineas = file($archivo);
            $encontrado = false;
    
            foreach ($lineas as $linea) {
                if (strstr($linea, $buscarDNI) !== false) {
                    $nota = trim($linea, strpos($linea, 'Nota:'));
                    echo "$nota";
                    $encontrado = true;
                }
            }
    
            if (!$encontrado) {
                echo "No se encontró ninguna nota asociada al DNI $buscarDNI.";
            }
        }
    ?>
    
</body>
</html>