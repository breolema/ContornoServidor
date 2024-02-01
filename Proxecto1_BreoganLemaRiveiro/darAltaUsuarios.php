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
      <a href="">Alta usuarios</a>
      <a href="">Modificar categorias</a>
      <a href="">Mdificar productos</a>
      <a href=""></a>
    </nav>
    <!--Formulario creacion usuarios-->
    <form method="POST">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" placeholder="Nombre" />
      <label for="correo">Correo:</label>
      <input type="text" id="correo" name="correo" placeholder="Correo" />
      <label for="clave">Contraseña:</label>
      <input type="password" id="clave" name="clave" placeholder="Contraseña" />
      <label for="pais">Pais:</label>
      <input type="text" id="pais" name="pais" placeholder="Pais" />
      <label for="cp">Codigo Postal:</label>
      <input type="number" id="cp" name="cp" placeholder="Codigo Postal" />
      <label for="ciudad">Ciudad:</label>
      <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad" />
      <label for="direccion">Dirección:</label>
      <input type="text" id="direccion" name="direccion" placeholder="Ciudad" />
      <?php
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
            ?>
      <div class="checkbox-container">
        <input type="checkbox" id="activo" name="activo" checked="checked"/>
        <label for="activo">Usuario activo</label>
      </div>
      <input type="submit" value="Dar de alta" />
    </form>

    <!--Inserccion de usuarios-->
      <?php
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
      
        $insert="INSERT INTO `usuarios` (`Nombre`, `Correo`, `Clave`,`Pais`, `CP`, `Ciudad`, `Direccion`, `Rol`, `Activo`) VALUES
        ('$nombre', '$correo', '$claveCifrada', '$pais', $cp, '$ciudad', '$direccion', $rol, $activo)";

        $result_Insert = $conexion->query($insert);

        if ($result_Insert) {
          $mensaje = "Se añadió el usuario correctamente.";
        } else {
          $mensaje = "Error al añadir el usuario, compruebe si esta cubriendo los campos correctamente.";
        }

      ?>
      <script>
          var mensaje = "<?php echo $mensaje; ?>";
          alert(mensaje);
      </script>

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
