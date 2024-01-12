<?php
    $item = $_GET['item'];
    $cantidad = $_GET['cantidad'];
    print($item);
    print($cantidad);
    $archivo="lista.xml";
    $listaCompra = simplexml_load_file($archivo);
    print_r($listaCompra);
    /*$xml=new SimpleXMLElement('<productos></productos>');
    print($xml);
    foreach ($listaCompra as $item=> $cantidad) {
        print($item);
        print($cantidad);
       $producto=$xml-> addChild('producto');
       $producto-> addChild('item',$item);
       $producto-> addChild('cantidad',$cantidad);

       $xml->asXML($archivo);
    }*/


   // header('Location: index.php');
?>