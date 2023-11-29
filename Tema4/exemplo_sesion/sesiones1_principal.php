<?php 
	session_start();
	if(!isset($_SESSION['usuario'])){	
		header("Location: sesiones1_login.php?redirigido=true");
	}	
	/* entramos na páxina e iniciamos sesión, comprobamos se a variable de
	sesión usuario está definida. Se está definica, pintamos a paxina html
	coa mensaxe de benbida ao usuario. Se non está definida, redireccionamos
	o control a páxina de login, co parámetro redirido a true,
	este parámetro servirános para diferenciar na páxina login se
	é a primeira vez que entramos ou pola contra, se chegamos a ela despois
	de ter tentado entrar na paxina principal e non ter permisos para facelo*/
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Página principal</title>
		<!--<link rel = "stylesheet" href = "./css/alta_usuarios.css">-->
		<meta charset = "UTF-8">
	</head>
	<body>		
		<?php echo "Bienvenido ".$_SESSION['usuario'];?>
		<br><a href = "sesiones1_logout.php"> Salir <a>
	</body>
</html>