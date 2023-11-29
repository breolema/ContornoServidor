<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 1</title>
    </style>

</head>
<body>

   <?php
            $articulosElegidos = $_POST['articulos'];
            $total = 0;            
            echo "<h1>Lista de la compra</h1>";
            if (isset($articulosElegidos)) {
                echo "<ul>";
                foreach ($articulosElegidos as $articulo => $valor){
                    echo "<li>".$articulo." - ".$valor."€</li>";
                    $total += $valor;
                }
                echo "</ul>";
            } else {
                echo "<p>No se ha seleccionado ningun artículo</p>";
            }
            echo "<p>Total: ".$total."€</p>";
    ?>

</body>
</html>