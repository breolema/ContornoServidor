<?php
session_start();

if (!isset($_SESSION["usuarioadmin"])) {
  header("Location: inicioSesion.php");
  exit;
}

include_once("conexionbd.php");
error_reporting(E_ALL ^ E_WARNING);

if (isset($_SESSION["mensaje"])) {
  echo "<script>alert('" . $_SESSION["mensaje"] . "');</script>";
  unset($_SESSION["mensaje"]);
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <title>Alta clientes</title>

  <link rel="stylesheet" href="css/estilos_AltaUsers.css">
  <link rel="stylesheet" href="css/comunTodos.css">
  <link rel="icon" type="image/jpg" href="imagenes/icono.png" />

</head>

<body>
  <nav>
    <img src="imagenes/icono.png" alt="logo" />
    <a href="todosPedidos.php">Pedidos</a>
    <a href="darAltaUsuarios.php">Alta usuarios</a>
    <a href="categoriasAdmin.php">Modificar categorias</a>
    <a href="productosAdmin.php">Modificar productos</a>
    <a href="historialMod.php">Historial Modificaciones</a>
    <div id="logout">
      <a href="logout.php"><img src="imagenes/logout.png"></a>
    </div>
  </nav>
  <!--Formulario creacion usuarios-->
  <?php
  //si o formulario recibe datos por get facemos que os pinte
  if (isset($_GET["codUsu"]) && isset($_GET["nombre"]) && isset($_GET["correo"]) && isset($_GET["pais"]) && isset($_GET["cp"]) && isset($_GET["ciudad"]) && isset($_GET["direccion"]) && isset($_GET["tipoRol"]) && isset($_GET["activo"])) {

    $codUsu = $_GET["codUsu"];
    $nombre = $_GET["nombre"];
    $correo = $_GET["correo"];
    $pais = $_GET["pais"];
    $cp = $_GET["cp"];
    $ciudad = $_GET["ciudad"];
    $direccion = $_GET["direccion"];
    if (isset($_GET['tipoRol'])) {
      if ($_GET['tipoRol'] == "Administrador") {
        $rol = 1;
      } else {
        $rol = 2;
      }
    }

    $activo = $_GET["activo"];

    //aqui se pintaran os datos dos usuarios que queiramos modificar
    echo '<form method="POST" action="modificarUsuarios.php">';
    echo '<label for="nombre">Nombre:</label>';
    echo '<input type="text" id="nombre" name="nombre" value="' . $nombre . '" required/>';
    echo '<label for="correo">Correo:</label>';
    echo '<input type="email" id="correo" name="correo" value="' . $correo . '" required/>';
    echo '<label for="clave">Contraseña:</label>';
    echo '<input type="password" id="clave" name="clave"/>';
    echo '<label for="pais">Pais:</label>';
    echo '<input type="text" id="pais" name="pais" value="' . $pais . '" required/>';
    echo '<label for="cp">Codigo Postal:</label>';
    echo '<input type="number" id="cp" name="cp" value="' . $cp . '" required/>';
    echo '<label for="ciudad">Ciudad:</label>';
    echo '<input type="text" id="ciudad" name="ciudad" value="' . $ciudad . '" required/>';
    echo '<label for="direccion">Dirección:</label>';
    echo '<input type="text" id="direccion" name="direccion" value="' . $direccion . '" required/>';
    echo "<label for='rol'>Rol usuario:</label>";
    echo "<select id='rol' name='rol'>";


    $sql_Roles = "SELECT codrol,descripcion FROM roles";
    $result_Roles = $conexion->query($sql_Roles);
    while ($fila = $result_Roles->fetch_assoc()) {
      $codrol = $fila["codrol"];
      $descripcion = $fila["descripcion"];
      if ($codrol == $rol) {
        echo "<option value='$codrol' selected>$descripcion</option>";
      } else {
        echo "<option value='$codrol'>$descripcion</option>";
      }
    }
    echo '</select>';
    echo '<div class="checkbox-container">';
    if ($activo == 1) {
      echo '<input type="checkbox" id="activo" name="activo" checked />';
    } else {
      echo '<input type="hidden" name="activo" value="0" />';
      echo '<input type="checkbox" id="activo" name="activo" />';
    }
    echo '<label for="activo">Usuario activo</label>';
    echo '</div>';
    echo '<input type="hidden" name="codUsu" value="' . $codUsu . '" />';
    echo '<input type="submit" value="Actualizar" />';
    echo '</form>';

  } else { //no caso de que non reciba datos este vaise pintar
  


    echo '<form action="insertarUsers.php" method="POST">';
    echo '<label for="usuario">Usuario:</label>';
    echo '<input type="text" id="usuario" name="usuario" placeholder="Usuario" required/>';
    echo '<label for="nombre">Nombre:</label>';
    echo '<input type="text" id="nombre" name="nombre" placeholder="Nombre" required/>';
    echo '<label for="correo">Correo:</label>';
    echo '<input type="email" id="correo" name="correo" placeholder="Correo" required/>';
    echo '<label for="clave">Contraseña:</label>';
    echo '<input type="password" id="clave" name="clave" placeholder="Contraseña" required/>';
    echo '<label for="pais">Pais:</label>';
    echo '<input type="text" id="pais" name="pais" placeholder="Pais" required/>';
    echo '<label for="cp">Codigo Postal:</label>';
    echo '<input type="number" id="cp" name="cp" placeholder="Codigo Postal" required/>';
    echo '<label for="ciudad">Ciudad:</label>';
    echo '<input type="text" id="ciudad" name="ciudad" placeholder="Ciudad" required/>';
    echo '<label for="direccion">Dirección:</label>';
    echo '<input type="text" id="direccion" name="direccion" placeholder="Dirección" required/>';
    $sql_Roles = "SELECT codrol,descripcion FROM roles";
    $result_Roles = $conexion->query($sql_Roles);
    if ($result_Roles->num_rows > 0) {
      echo "<label for='rol'>Rol usuario:</label>";
      echo "<select id='rol' name='rol'>";
      while ($fila = $result_Roles->fetch_assoc()) {
        echo "<option value='" . $fila["codrol"] . "'>" . $fila["descripcion"] . "</option>";
      }
      echo "</select>";
    }
    echo '<div class="checkbox-container">';
    echo '<input type="checkbox" id="activo" name="activo" checked="checked"/>';
    echo '<label for="activo">Usuario activo</label>';
    echo '</div>';
    echo '<input type="submit" value="Dar de alta" />';
    echo '</form>';



  }

  //tabla que enseña os usuarios
  
  $sql_Usuarios = "SELECT usuarios.*, roles.Descripcion AS tipoRol FROM usuarios INNER JOIN roles ON roles.CodRol = usuarios.Rol";
  $result_Usuarios = $conexion->query($sql_Usuarios);

  if ($result_Usuarios->num_rows > 0) {
    echo "<table border=1>";
    echo "<tr>";
    echo "<th>Codigo</th><th>Usuario</th><th>Nombre</th><th>Correo</th><th>Pais</th><th>Direccion</th>
          <th>Ciudad</th><th>Codigo Postal</th><th>Rol</th><th>Activo</th><th>Modificar</th><th>Borrar</th>";
    echo "</tr>";
    while ($fila = $result_Usuarios->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $fila['CodUsu'] . "</td>";
      echo "<td>" . $fila['Usuario'] . "</td>";
      echo "<td>" . $fila['Nombre'] . "</td>";
      echo "<td>" . $fila['Correo'] . "</td>";
      echo "<td>" . $fila['Pais'] . "</td>";
      echo "<td>" . $fila['Direccion'] . "</td>";
      echo "<td>" . $fila['Ciudad'] . "</td>";
      echo "<td>" . $fila['CP'] . "</td>";
      echo "<td>" . $fila['tipoRol'] . "</td>";
      if ($fila['Activo'] == 1) {
        echo "<td>Activo</td>";
      } else {
        echo "<td>Desactivo</td>";
      }
      echo "<td><a href='darAltaUsuarios.php?codUsu=" . $fila['CodUsu'] . "&nombre=" . $fila['Nombre'] . "&correo=" . $fila['Correo'] . "&pais=" . $fila['Pais'] . "&direccion=" . $fila['Direccion'] . "&ciudad=" . $fila['Ciudad'] . "&cp=" . $fila['CP'] . "&tipoRol=" . $fila['tipoRol'] . "&activo=" . $fila['Activo'] . "'><button>Modificar</button></a></td>";
      echo "<td><a href='borrarUsuarios.php?codUsu=" . $fila['CodUsu'] . "'><button>Borrar</button></a></td>";
      echo "</tr>";
    }
    echo "</table>";
  }

  ?>
</body>

</html>