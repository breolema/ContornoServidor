<?php
// exemplo que percorre un ficheiro xml, paseao e inserta os datos nunha base de datos
$conn = mysqli_connect("localhost", "root", "", "probas");

$filasAfectada = 0;

$xml = simplexml_load_file("libros.xml") or die("Error: No se puede cargar el fichero xml");

foreach ($xml->children() as $fila) {
    
    $titulo = $fila->titulo;
    $autor = $fila->autor;
    $sinopsis = $fila->sinopsis;
    $isbn = $fila->isbn;
    
    $sql = "INSERT INTO libros(titulo,autor,sinopsis,isbn) VALUES ('" . $titulo . "','" . $autor . "','" . $sinopsis . "','" . $isbn . "')";
    
    $result = mysqli_query($conn, $sql);
    
    if (! empty($result)) {
        $filasAfectada ++;
    } else {
        $error_message = mysqli_error($conn) . "n";
    }
}