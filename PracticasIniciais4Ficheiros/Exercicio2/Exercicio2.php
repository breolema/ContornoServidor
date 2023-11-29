<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 2</title>
</head>
<body>
    <h1>Rexistro de notas</h1>
    <p><strong>Antes de abrir o rexístro de datos hai que introducir algún dato mediante o formulario</strong></p>
    <form method="post">
    <p>DNI:  <input type="text" name="dni"></p>
    <label for="nota">Nota:</label>
    <select id="nota" name="nota">
        <option value="10">10</option>
        <option value="9">9</option>
        <option value="8">8</option>
        <option value="7">7</option>
        <option value="6">6</option>
        <option value="5">5</option>
        <option value="4">4</option>
        <option value="3">3</option>
        <option value="2">2</option>
        <option value="1">1</option>
    </select>
    <p><input type="submit" value="Rexistrar"></p>
    </form>

    <p><a href="rexistro.php">Abrir rexistro de datos</a></p>
    <p><a href="buscarNota.php">Buscar nota por DNI</a></p>

    <?php
    //print "<pre>";
    //print_r ($_POST);
    //print "</pre>";
        if(empty($_POST['dni']) || empty($_POST['nota'])){
            echo "Hai campos sin rexistro";
        }else {
        $file=fopen("notas.txt" , "a");
        $dni=($_POST['dni']);
        $nota=($_POST['nota']);
        $page = " ";

        $page .= "<b>DNI: $dni  -   Nota: $nota <br><hr></b>$";

        fwrite($file,"$page",strlen("$page"));
        fclose($file);
        }
    ?>
    
</body>
</html>