<?php
	session_start();    // unirse a sesión
					
	$_SESSION = array();
	session_destroy();	// eliminar a sesion
	setcookie(session_name(), 123, time() - 1000); // eliminar a cookie
	header("Location: sesiones1_login.php");