<?php
	session_start();
	if (!isset($_SESSION['count'])) {
	  $_SESSION['count'] = 0;
	} else {
	  $_SESSION['count']++;
	}
	echo "ola " .$_SESSION['count'];
	echo "<br><a href='sesiones_uso_basico2.php'>Siguiente</a>";
/* 
iniciamos a sesión, comprobamos se a variable de sesión count 
está definida, se non o está, asignamos o valor 0
si xa o está, aumentamos o valor en 1 unidade.
Dende o enlace, saltamos a páxina 2...
*/
?>
