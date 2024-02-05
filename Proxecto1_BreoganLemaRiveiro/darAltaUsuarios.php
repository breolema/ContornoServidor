<?php
    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("Location: inicioSesion.php");
        exit;
    }

    $conexion = mysqli_connect("localhost", "root", "", "supermercado");
    
    ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Alta clientes</title>
    
    <link rel="stylesheet" href="css/estilos_AltaUsers.css">
    <link rel="stylesheet" href="css/comunTodos.css">

  </head>
  <body>
    <nav>
      <img src="imagenes/icono.png" alt="logo" />
      <a href="paginaGeneralAdmin.php">General</a>
      <a href="darAltaUsuarios.php">Alta usuarios</a>
      <a href="categoriasAdmin.php">Modificar categorias</a>
      <a href="productosAdmin.php">Mdificar productos</a>
      <a href=""></a>
    </nav>
    <!--Formulario creacion usuarios-->
    <?php
    //Si o formulario non ten datos facemos que este se pinte vacio
      if(!isset($_GET["nombre"])||!isset($_GET["correo"])||!isset($_GET["clave"])||!isset($_GET["pais"])||!isset($_GET["cp"])||!isset($_GET["ciudad"])||!isset($_GET["direccion"])||!isset($_GET["rol"])||!isset($_GET["activo"])){
        echo '<form method="POST">';
        echo '<label for="nombre">Nombre:</label>';
        echo '<input type="text" id="nombre" name="nombre" placeholder="Nombre" />';
        echo '<label for="correo">Correo:</label>';
        echo '<input type="text" id="correo" name="correo" placeholder="Correo" />';
        echo '<label for="clave">Contraseña:</label>';
        echo '<input type="password" id="clave" name="clave" placeholder="Contraseña" />';
        echo '<label for="pais">Pais:</label>';
        echo '<input type="text" id="pais" name="pais" placeholder="Pais" />';
        echo '<label for="cp">Codigo Postal:</label>';
        echo '<input type="number" id="cp" name="cp" placeholder="Codigo Postal" />';
        echo '<label for="ciudad">Ciudad:</label>';
        echo '<input type="text" id="ciudad" name="ciudad" placeholder="Ciudad" />';
        echo '<label for="direccion">Dirección:</label>';
        echo '<input type="text" id="direccion" name="direccion" placeholder="Dirección" />';
        $sql_Roles="SELECT codrol,descripcion FROM roles";
        $result_Roles = $conexion->query($sql_Roles); 
               if ($result_Roles->num_rows > 0) { 
                  echo "<label for='rol'>Rol usuario:</label>"; 
                  echo "<select id='rol' name='rol'>"; 
                  while ($fila = $result_Roles -> fetch_assoc()) { 
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

        $nombre=$_POST["nombre"];
        $correo=$_POST["correo"];
        $clave=$_POST["clave"];
        $claveCifrada=md5($clave);
        $pais=$_POST["pais"];
        $cp=$_POST["cp"];
        $ciudad=$_POST["ciudad"];
        $direccion=$_POST["direccion"];
        $rol=$_POST["rol"];
        if (isset($_POST['activo'])) {
          $activo = 1;
        } else {
          $activo = 0;
        }
      
      //Inserccion de usuarios
        $insert="INSERT INTO `usuarios` (`Nombre`, `Correo`, `Clave`,`Pais`, `CP`, `Ciudad`, `Direccion`, `Rol`, `Activo`) VALUES
        ('$nombre', '$correo', '$claveCifrada', '$pais', $cp, '$ciudad', '$direccion', $rol, $activo)";

        $result_Insert = $conexion->query($insert);

        if ($result_Insert) {
          $mensaje = "Se añadió el usuario correctamente.";
        } else { 
          $mensaje = "Error al añadir el usuario, compruebe si esta cubriendo los campos correctamente.";
        }

        echo '<script>';
        echo 'var mensaje = "<?php echo $mensaje; ?>"';
        echo 'alert(mensaje)';
        echo  '</script>';

      } else { //No caso de que queiramos modificar algún usuario mandamos os datos pola cabeceira no boton da tabla de abaixo

        $nombre=$_GET["nombre"];
        $correo=$_GET["correo"];
        //$clave=$_GET["clave"];
        //$claveCifrada=md5($clave);
        $pais=$_GET["pais"];
        $cp=$_GET["cp"];
        $ciudad=$_GET["ciudad"];
        $direccion=$_GET["direccion"];
        $rol=$_GET["rol"];
        if (isset($_GET['activo'])) {
          $activo = 1;
        } else {
          $activo = 0;
        }

        echo '<form method="POST">';
        echo '<label for="nombre">Nombre:</label>';
        echo '<input type="text" id="nombre" name="nombre" >' . $nombre. ' </input>';
        echo '<label for="correo">Correo:</label>';
        echo '<input type="text" id="correo" name="correo" >' . $correo. ' </input>';
        echo '<label for="clave">Contraseña:</label>';
        echo '<input type="password" id="clave" name="clave" >' . $clave. ' </input>';
        echo '<label for="pais">Pais:</label>';
        echo '<input type="text" id="pais" name="pais"  >' . $pais. ' </input>';
        echo '<label for="cp">Codigo Postal:</label>';
        echo '<input type="number" id="cp" name="cp" >' . $cp. ' </input>';
        echo '<label for="ciudad">Ciudad:</label>';
        echo '<input type="text" id="ciudad" name="ciudad" >' . $ciudad. ' </input>';
        echo '<label for="direccion">Dirección:</label>';
        echo '<input type="text" id="direccion" name="direccion" >' . $direccion. ' </input>';
        $sql_Roles="SELECT codrol,descripcion FROM roles";
        $result_Roles = $conexion->query($sql_Roles); 
               if ($result_Roles->num_rows > 0) { 
                  echo "<label for='rol'>Rol usuario:</label>"; 
                  echo "<select id='rol' name='rol'>"; 
                  while ($fila = $result_Roles -> fetch_assoc()) {
                  $codrol = $fila["codrol"];
                  $descripcion = $fila["descripcion"];
                  if ($codrol == $_GET["rol"]) {
                    echo "<option value='$codrol' selected>$descripcion</option>";
                } else {
                    echo "<option value='$codrol'>$descripcion</option>";
                }
                  } 
                  echo "</select>"; 
              } 
        echo '<div class="checkbox-container">';
        echo '<input type="checkbox" id="activo" name="activo" ';
        if ($_GET["activo"] == 1) {
              echo 'checked';
        }
        echo '/>';
        echo '<label for="activo">Usuario activo</label>';
        echo '</div>';
        echo '<input type="submit" value="Dar de alta" />';
        echo '</form>';

      }
    ?>
        
        
    <!--Tabla que enseña os usuarios-->
      <?php
        $sql_Usuarios="SELECT usuarios.*, roles.Descripcion AS tipoRol FROM usuarios INNER JOIN roles ON roles.CodRol = usuarios.Rol";
        $result_Usuarios = $conexion->query($sql_Usuarios);
        
        if ($result_Usuarios->num_rows > 0) {
          echo "<table border=1>";
          echo "<tr>";
          echo "<th>Codigo</th><th>Nombre</th><th>Correo</th><th>Pais</th><th>Direccion</th>
          <th>Ciudad</th><th>Codigo Postal</th><th>Rol</th><th>Activo</th><th>Modificar</th>";
          echo "</tr>";
          while ($fila = $result_Usuarios -> fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $fila['CodUsu'] . "</td>";
            echo "<td>" . $fila['Nombre'] . "</td>";
            echo "<td>" . $fila['Correo'] . "</td>";
            echo "<td>" . $fila['Pais'] . "</td>";
            echo "<td>" . $fila['Direccion'] . "</td>";
            echo "<td>" . $fila['Ciudad'] . "</td>";
            echo "<td>" . $fila['CP'] . "</td>";
            echo "<td>" . $fila['tipoRol'] . "</td>";
            if($fila['Activo']==1){
              echo "<td>Activo</td>";
            }else {
              echo "<td>Desactivo</td>";
            }
            echo "<td><a href='modificarUsuario.php'><button>Modificar</button></a></td>";
            echo "</tr>";
          }
          echo "</table>";
        }

      ?>
  </body>
</html>
