<?php
	session_start();
	echo "La variable count vale: " . $_SESSION['count']; 

/* iniciamos a sesión, e pintamos o valor da 
variable count....e esta páxina vai pintar esa
información correcta ainda que se abran multiples
páxinas, sempre que teamos na mesma sesión, cousa
distinta é se abrimos de novo o navegador, iso sería outrra sesion
e o valor de count contaría de novo.
*/
?>