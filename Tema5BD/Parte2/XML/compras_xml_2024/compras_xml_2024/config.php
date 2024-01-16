<?php
// Ruta do archivo XML
$titulo = "Compras do Departamento";
$rutaDatosXML = 'cesta.xml';

function leerDatos() {
    global $rutaDatosXML;

    if (file_exists($rutaDatosXML) && filesize($rutaDatosXML) > 0) {
        $xml = simplexml_load_file($rutaDatosXML);//cargamos o ficheiro xml

        if ($xml !== false) {
            $datos = []; //inicializamos o arrai

            foreach ($xml->producto as $producto) { //percorremos o xml
                $nombre = (string)$producto->nombre;
                $cantidad = (int)$producto->cantidad;
                $datos[$nombre] = $cantidad;  //creamos o arrai cos datos que veñen do xml.
            }

            return $datos;
        }
    }

    // Si o arquivo non existe ou está vacío, retornar un arrai vacío
    return [];
}

function guardarDatos($datos) {
    global $rutaDatosXML;

    $xml = new SimpleXMLElement('<cesta></cesta>');

    foreach ($datos as $nombre => $cantidad) { //percorremos o arrai e 
        $producto = $xml->addChild('producto');//imos engadindo os elementos do xml
        $producto->addChild('nombre', $nombre);
        $producto->addChild('cantidad', $cantidad);
    }

    $xml->asXML($rutaDatosXML);
}
?>