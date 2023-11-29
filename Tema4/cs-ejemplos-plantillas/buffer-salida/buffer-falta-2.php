<?php
/*En un entorno de producción se suele utilizar un buffer de salida, 
  pero este puede enmascarar errores de programación (básicamente, la
  creación de contenido de la página antes del envío de cabeceras,
  Por eso es conveniente desactivar el buffer y poder detectar ese tipo 
  de errores al escribir los programas.
  output_buffering = 0        ; Valor recomendado en este curso
*/

//LEMBRAR DESACTIVAR A VARIABLE output_buffering e poñelo a cero no ficheiro php.ini

$buffer = 20;  //eswtablecemos un buffer temporal de 20 byte e un texto inferior
ob_start(null, $buffer);
print "<p>Tamaño: $buffer</p>"; //tamaño inferior a 20 bytes, fai a redirección correctamente
header("Location:buffer-falta-3.php");
print "<p>La redirección <strong>NO</strong> se ha realizado.</p>\n";
print "<p><a href=\"buffer-falta-1.php\">Volver al principio</a></p>\n";
//a redireccion falla porque 