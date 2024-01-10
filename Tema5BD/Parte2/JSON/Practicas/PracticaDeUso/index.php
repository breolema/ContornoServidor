<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.c
ss">
</head>

<body>
    <div class='container'>
        <h1 class='text-center'></h1>
        <div class="row">
            <table class='table table-bordered table-striped'>
                <tr>
                    <th>Artículo</th>
                    <th>Cantidad</th>
                    <th colspan='2' class='text-center'>
                    </th>
                    <th colspan='2' class='text-center'>
                    </th>
                </tr>
                    <?php
                        $archivo="lista.json";
                        if(file_exists($archivo)){
                            $jsonString = file_get_contents($archivo);
                            $listaCompra = json_decode($jsonString, true);
                        } else {
                            $listaCompra = array();
                        }

                        foreach($listaCompra as $producto){
                            echo "<tr>";
                                echo "<td>" . $producto['item'] . "</td>";
                                echo "<td>" . $producto['cantidad'] . "</td>";
                                echo "<td><a href='añadir.php?cantidad=1' class='glyphicon glyphicon-plus'></a></td>";
                                echo "<td><a href='añadir.php?cantidad=-1' class='glyphicon glyphicon-minus'></a></td>";
                                echo "<td><a href='añadir.php?cantidad=0' class='glyphicon glyphicon-remove-circle'></a></td>";
                                echo "<td><a href='borrar.php' class='glyphicon glyphicon-trash'></a></td>";
                            echo "</tr>";
                        }
                    ?>
                <tr>
                    <td>
                        <form class='form-inline' action='añadir.php'>
                            <input type='text' name='item' class='form-control' style='width:300px'>
                            <input type='hidden' name='verTodo' value=''>
                    </td>
                    <td>
                        <div class='col-xs-6'><input type='number' name='cantidad' value='1' class='form-control'></div>
                    </td>
                    <td colspan='4'>
                        <div class='text-center'><input type='submit' value='+' class='btn btnprimary btn-sm'></div>
                    </td>
                    </form>
            </table>
        </div>
    </div>
</body>

</html>