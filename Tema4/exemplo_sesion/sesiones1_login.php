<?php
/*formulario de login habitual nunha web..
se a conexión vai ben, abre sesión, garda o nome do usuario na sesión, e redirixe a páxina principal.php 
se vai mal, mensaxe de error
SON PROBAS E O USUARIO É usuario E A CONTRASINAL É 1234 */
function comprobar_usuario($nombre, $clave){
	if($nombre === "usuario" and $clave === "1234"){
		$usu['nombre'] = "usuario";
		$usu['rol'] = 0;
		return $usu;
	}elseif($nombre === "admin" and $clave === "1234"){
		 $usu['nombre'] = "admin";
		 $usu['rol'] = 1;
		 return $usu;
	}else return false;
	/* a funcion vai devolver un arrai usu co nome do usuario e o rol, en caso de 
	que os valores sexan correctos ou un false, en caso contraio 
	*/
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {  	 /* usamos o POST porque no formulario enviamos por POST */
	/*estamos comprobando se neste punto estamos procesando o formulario unha vez que o 
	  usuairo pulsou o boton de enviar no formulario */

	$usu = comprobar_usuario($_POST['usuario'], $_POST['clave']);
	if($usu==false){
		$err = true;
		$usuario = $_POST['usuario'];
	}else{	/*se atinamos co usuario e contrasinal, daquela poderemos entrar na paxina principal e creamos previamente 
		     a variable de sesión, inicializamos sesión, creamos a variable co dato do usuario*/
		session_start();
		$_SESSION['usuario'] = $_POST['usuario'];
		header("Location: sesiones1_principal.php");	/*redireccionamos a páxina principal*/
	}
	
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Formulario de login</title>		
		<meta charset = "UTF-8">
	</head>
	<body>	
		<!-- No propio formulario de validación, controlamos se cando tentamos abrir o formulario
		temos definido o parámetro "redirigido", en caso de telo, ven significando
		que chegamos a el dende a páxina principal, seguramente porque tentamos
		entrar na páxina principal sen ter o usuario validado, ou sen ter a sesión creada...
		é dicir, estamos tentando saltarnos o proceso de validación...
		-->
		
		<?php if(isset($_GET["redirigido"])){
			echo "<p>Fai  login para continuar</p>";
		}?>
		<!-- Neste caso, controlamos tamen que o usaurio metiu un valor de 
		usuario e contraseña incorrecta, e por tanto, non se puido crear a sesión,
		deste xeito, amosamos en pantalla o aviso de que o usuario e contrasinal
		son incorrectos.-->
		<?php if(isset($err) and $err == true){
			echo "<p> revise usuario e contrasinal</p>";
		}?>
		<!-- a sintaxis php echo htmlspecialchars($_SERVER["PHP_SELF"]) é a que se debería usar
		a hora de poñer como ruta de validación php dun formulario a propia páxina na que esta
		o formulario, tamen o podemos facer como ata agora, 
		poñendo directamente o nome da páxina php no action, pero deste
		xeito (xa o veremos mais adiante), é mais profesional e xenérico xa que a variable PHP_SELF sempre se
		garda o valor do script php que se está executando. 
	-->
		<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "POST">
			Usuario
			<input value = "<?php if(isset($usuario))echo $usuario;?>"
			id = "usuario" name = "usuario" type = "text">							
			Clave			
			<input id = "clave" name = "clave" type = "password">						
			<input type = "submit">
		</form>
	</body>
</html>