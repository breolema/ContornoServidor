<?php
    $item = $_GET['producto'];
    $archivo="lista.json";

    $jsonString = file_get_contents($archivo);
    $listaCompra = json_decode($jsonString, true);

    foreach($listaCompra as $key=> $producto){
        if (array_key_exists('item', $producto) && $producto['item'] === $item) {
            $listaCompra[$key]['cantidad']=$producto['cantidad']-1;
            break;
        }
    }

    $jsonActualizado = json_encode($listaCompra);
    file_put_contents($archivo, $jsonActualizado);
    header('Location: index.php');
?>