<?php
/* percorre un ficheiro con formato xml que se atopa
almacenado en unha cadea string...
*/
/*Si los datos en formato XML están en un string, 
se puede utilizar la función: _simplexml_loadstring($string):
    */

$string = '<usuarios>
    <usuario>
        <nombre>Monnie</nombre>
        <apellido>Boddie</apellido>
        <direccion>Calle Pedro Mar 12</direccion>
        <ciudad>Mexicali</ciudad>
        <pais>Mexico</pais>
        <contacto>
            <telefono>44221234</telefono>
            <url>http://monnie.ejemplo.com</url>
            <email>monnie@ejemplo.com</email>
        </contacto>
    </usuario>
    </usuarios>';
if(!$xml = simplexml_load_string($string)){
    echo "No se ha podido cargar el archivo";
} else {
    /*Con el archivo cargado correctamente, se puede acceder a los datos contenidos 
    en cada uno de los elementos, para mostrarlos, asignarlos a variables, 
    manipularlos...
    */
   
    echo "El archivo se ha cargado correctamente";
    foreach ($xml as $usuario){
        echo 'Nombre: '.$usuario->nombre.'<br>';
        echo 'Apellido: '.$usuario->apellido.'<br>';
        echo 'Dirección: '.$usuario->direccion.'<br>';
        echo 'Ciudad: '.$usuario->ciudad.'<br>';
        echo 'País: '.$usuario->pais.'<br>';
        echo 'Teléfono: '.$usuario->contacto->telefono.'<br>';
        echo 'Url: '.$usuario->contacto->url.'<br>';
        echo 'Email: '.$usuario->email->nombre.'<br>';
    }
}
/*
El ejemplo anterior primero carga el string con el método DomDocument::loadXML. 
Este objeto ahora puede importarse directamente a SimpleXML 
con la función _simplexml_importdom(). 
El resultado es el mismo que llamando a _simplexml_loadfile() 
o _simplexml_loadstring().
*/
?>