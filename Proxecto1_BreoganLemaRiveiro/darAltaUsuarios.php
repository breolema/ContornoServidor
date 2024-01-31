<?php
    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("Location: inicioSesion.php");
        exit;
    }

    $conexion = mysqli_connect("localhost", "root", "", "supermercado");
    $sql="SELECT descripcion FROM roles";
    $result = $conexion->query($sql); 
    ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <title>Alta clientes</title>
    <style>
      body {
        margin: 0px;
        text-align: center;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
        background-color: #fce4c6;
      }

      nav {
        background-color: #333;
        overflow: hidden;
      }

      nav a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 25px 16px;
        text-decoration: none;
      }

      nav a:hover {
        background-color: #ddd;
        color: black;
      }

      nav img {
        float: left;
        padding: 10px;
        height: 50px;
      }

      form {
        margin: 20px auto;
        width: 80%;
        max-width: 600px;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      form label {
        display: block;
        text-align: left;
        margin-bottom: 8px;
      }

      form input[type="text"],
      form input[type="password"],
      form input[type="number"],
      form select {
        width: calc(100% - 20px);
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
      }

      form input[type="checkbox"] {
        margin-right: 5px;
        display: flex;
      }

      form input[type="submit"] {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
      }

      form input[type="submit"]:hover {
        background-color: #555;
      }

      .checkbox-container {
        display: flex;
        align-items: center;
      }

      .checkbox-container label {
        margin-top: 7px;
      }

      .checkbox-container input[type="checkbox"] {
        margin-right: 5px;
      }
    </style>
  </head>
  <body>
    <nav>
      <img src="imagenes/icono.png" alt="logo" />
      <a href="">Alta usuarios</a>
      <a href="">Modificar categorias</a>
      <a href="">Mdificar productos</a>
      <a href=""></a>
    </nav>
    <form method="POST">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" placeholder="Nombre" />
      <label for="correo">Correo:</label>
      <input type="text" id="correo" name="correo" placeholder="Correo" />
      <label for="clave">Contraseña:</label><br />
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
             if ($result->num_rows > 0) { 
                $contador=0; 
                echo "<label for='rol'>Rol usuario:</label>"; 
                echo "<select id='rol' name='rol'>"; 
                while ($fila = $result -> fetch_assoc()) { 
                    echo "<option value='$contador'>" . $fila["descripcion"] . "</option>"; 
                    $contador++; 
                } 
                echo "</select>"; 
            } 
            ?>
      <div class="checkbox-container">
        <input type="checkbox" id="activo" name="activo" value="Activo" />
        <label for="activo">Activar usuario</label>
      </div>
      <input type="submit" value="Dar de alta" />
    </form>
  </body>
</html>
