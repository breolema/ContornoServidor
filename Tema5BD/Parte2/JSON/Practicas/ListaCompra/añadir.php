<?php
    $item = $_GET['item'];
    $cantidad = $_GET['cantidad'];
    $archivo="lista.json";
    $listaCompra = array();
    
    if(file_exists($archivo)){
        $jsonString = file_get_contents($archivo);
        $listaCompra = json_decode($jsonString, true);
    } else {
        $listaCompra = array();
    }

    $articuloExistente = false;
    foreach ($listaCompra as &$producto) {
        if (array_key_exists('item', $producto) && $producto['item'] === $item) {
            $producto['cantidad'] += $cantidad;
            $articuloExistente = true;
            break;
        }
    }

    if (!$articuloExistente){
        $productoNuevo = array('item' => $item, 'cantidad' => $cantidad);
        $listaCompra[] = $productoNuevo;
    }

    $jsonString = json_encode($listaCompra);
    file_put_contents($archivo, $jsonString);

    header('Location: index.php');
?>