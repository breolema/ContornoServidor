<?php
// !!!!para probar o pete do buffer, imos a instalación de php (php.ini)
// ou dende o xamp, e modificamos o valor da variable global output_buffering=0!!!!
header("Location:cabeceras-header-1-3.php");
print "<p>Esta es la página 2</p>";
print "<p>La redirección <strong>NO</strong> se ha realizado</p>";
print "<p><a href=\"cabeceras-header-1-1.php\">Volver a la página 1</a></p>";

// caso 1: ; output_buffering=0 Sen espazos antes do php -> redirixe
// caso 2: ; output_buffering=0 Con espazos en blanco ou texto -> erro
// caso 3: output_buffering=0 (descomentado) Sen espazos antes do php -> redirixe
// caso 4: output_buffering=0 (descomentado) con espaxos ou textp  -> erro


