<html>
<head>
<title>Exercicio1_2</title>
</head>
<body>
    <form action="Exercicio1_3.php" method="GET">
        <p>Elija la localidad deseada 
            <?php 
            $conexion=mysqli_connect("localhost","root","","geografia"); 

            $comunidad = "";

            if (isset($_GET['provincias'])) {
                $provincia = $_GET['provincias'];
            } else {
                header("Location: Exercicio1_1.php");
            }

            $sql= "SELECT LOCALIDADES.NOMBRE FROM LOCALIDADES  JOIN PROVINCIAS ON PROVINCIAS.N_PROVINCIA=LOCALIDADES.N_PROVINCIA WHERE PROVINCIAS.NOMBRE = '$provincia'";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                echo "<select id='localidades' name='localidades'>";
                while($row = $result->fetch_assoc()) {
                    echo "<option value=" .  $row["NOMBRE"] .">" . $row["NOMBRE"] . "</option>";
                }
                echo "</select>";
            }
            ?></p>
            <input type="hidden" name="provincias" value="<?php echo "$provincia" ?>">
            <input type="submit" value="Enviar">
    </form>
<?php
    if(isset($_GET['localidades'])){
        $localidad=$_GET['localidades'];
        $poblacion="SELECT POBLACION FROM LOCALIDADES JOIN PROVINCIAS ON PROVINCIAS.N_PROVINCIA=LOCALIDADES.N_PROVINCIA WHERE LOCALIDADES.NOMBRE = '$localidad'";
        
        $poblacion_result = $conexion->query($poblacion);
        if ($poblacion_result->num_rows > 0) {
            while($row = $poblacion_result->fetch_assoc()) {
                echo "<p> Localidad $localidad, poblacion= " . $row["POBLACION"] . "</p>";
            }
        }
    }
?>
</body>
</html>