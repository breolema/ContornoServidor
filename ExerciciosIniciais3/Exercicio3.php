<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Exercicio 3</title>
    <style type="text/css">
        td,
        th {
            border: 1px solid grey;
            padding: 4px;
        }

        th {
            text-align: center;
            background-color: #67b4b4;
        }

        table {
            border: 1px solid black;
        }

        div {
            padding: 10px 20px
        }

        h1 {
            font-family: sans-serif;
            font-style: italic;
            texttransform: capitalize;
            color: #008000;
        }

        .bajoDch {
            float: right;
            position: absolute;
            margin-right: 0px;
            margin-bottom: 0px;
            bottom: 0px;
            right: 0px;
        }

        .altoDch1 {
            color: #00f;
            float: right;
            position: absolute;
            marginright: 0px;
            margin-top: 0px;
            top: 0px;
            right: 0px;
        }

        .altoDch2 {
            color: #f00;
            float: right;
            position: absolute;
            marginright: 0px;
            margin-top: 0px;
            top: 0px;
            right: 0px;
        }
    </style>
</head>

<body>
    <h1>Axenda telefonica</h1>
    <form method="get">
        <div class="bajoDch">
        <fieldset>
            <legend>Nombre</legend>
            <input type="text" name="nombre">
        </fieldset>
        <fieldset>
            <legend>Teléfono</legend>
            <input type="number" name="numero"></fieldset>
         <br><input type="submit" value="Aplicar cambios"></p>
         </div>
    </form>
    <?php
         $agenda=[];
         
            
                    $nombre=$_GET["nombre"];
                    $numero=$_GET["numero"];

                   if(empty($nombre)){
                        echo "Introduce un nombre válido";
                   } else {
                        if(isset($_GET["nombre"]) && isset($_GET["numero"])){
                            
                        }
                   }
            

            if (!empty($agenda)) {
                echo "<table>";
                echo "<tr>";
                echo "<th>Nombre</th>";
                echo "<th>Teléfono</th>";
                echo "</tr>";
                foreach ($agenda as $nombre => $numero) {
                    echo "<tr>";
                    echo "<td>$nombre</td>";
                    echo "<td>$numero</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
   ?>

</body>

</html>