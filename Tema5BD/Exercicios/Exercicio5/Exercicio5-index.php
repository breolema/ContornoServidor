<?php
    session_start();
    $conexion=mysqli_connect("localhost","root","","geografia");
    $sql_localidad= "SELECT nombre FROM localidades ORDER BY RAND() LIMIT 1;";
    $result_nombreLocalidad = $conexion->query($sql_localidad);

    $sql_provincias="SELECT NOMBRE FROM PROVINCIAS";
    $result_nombreProvincia = $conexion->query($sql_provincias);
?>

<html>
<head>
<title>Exercicio5-index</title>
</head>
<body>
    <h1>Adivina la provincia</h1>
    <form action="Exercicio5-comprobacion.php" method="POST">
    <p>Localidad: <strong>
        <?php 
        if ($result_nombreLocalidad->num_rows > 0) {
            while($row = $result_nombreLocalidad->fetch_assoc()) {
                $localidad= $row["nombre"];
                echo $localidad ;
            } 
            } ?></strong>
            <input type="hidden" value="<?php echo '$localidad' ?>">
        <?php  if ($result_nombreProvincia->num_rows > 0) {
                echo "<br><select id='provincias' name='provincias'>";
                while($row = $result_nombreProvincia->fetch_assoc()) {
                    echo "<option value=" .  $row["NOMBRE"] .">" . $row["NOMBRE"] . "</option>";
                }
                echo "</select>";
            }
            ?>    
        </p>
    <input type="submit" value="Comprobar">
    </form>
</body>
</html>