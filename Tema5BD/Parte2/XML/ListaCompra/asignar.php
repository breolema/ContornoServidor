<?php
 $item = $_GET['producto']; 
 $cantidad = $_GET['cantidad'];
 $archivo="lista.json";

 $articulos=new SimpleXMLElement('<productos></productos>');

 foreach($listaCompra as $key=> $producto){
     if (array_key_exists('item', $producto) && $producto['item'] === $item) {
        if($cantidad == 0){
            $listaCompra[$key]['cantidad']=0;
            break;
        }else{
            $listaCompra[$key]['cantidad'] = $producto['cantidad'] + $cantidad;
            break;
        }
     }
 }

 $jsonActualizado = json_encode($listaCompra);
 file_put_contents($archivo, $jsonActualizado);    
 header('Location: index.php');
?>
?>