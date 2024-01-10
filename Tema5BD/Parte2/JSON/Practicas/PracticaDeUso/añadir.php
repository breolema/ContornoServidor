<?php
    $item = $_GET['item'];
    $cantidad = $_GET['cantidad'];
    $listaCompra = array();
    
    $archivo="lista.json";
    if(file_exists($archivo)){
        $jsonString = file_get_contents($archivo);
        $listaCompra = json_decode($jsonString, true);
    } else {
        $listaCompra = array();
    }

    $articuloExiste=false;
    foreach ($listaCompra as $producto){
        if ($producto['item'] === $item) {
            $producto['cantidad'] += $cantidad;
            $articuloExistente = true;
            break;
        }
    }

    if (!$articuloExiste){
        $productoNuevo = array('item' => $item, 'cantidad' => $cantidad);
        $listaCompra[] = $productoNuevo;
    }

    $jsonString = json_encode($listaCompra);
    file_put_contents($archivo, $jsonString);

    header('Location: index.php');
?>
?>