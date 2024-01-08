<?php

/* PENDENTE DE TERMINAR NA CLASE */

/* carga un ficherio xml externo, e procede a percorrer
os disintos elementos que o conforman
*/

if(!$xml = simplexml_load_file('usuarios.xml')){
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

?>