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

            if (isset($_GET['comunidades'])) {
                $comunidad = $_GET['comunidades'];
            } else {
                header("Location: Exercicio1_1.php");
            }

            $sql= "SELECT PROVINCIAS.NOMBRE FROM PROVINCIAS  JOIN COMUNIDADES ON COMUNIDADES.ID_COMUNIDAD=PROVINCIAS.ID_COMUNIDAD WHERE COMUNIDADES.NOMBRE = '$comunidad'";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                echo "<select id='provincias' name='provincias'>";
                while($row = $result->fetch_assoc()) {
                    echo "<option value=" .  $row["NOMBRE"] .">" . $row["NOMBRE"] . "</option>";
                }
                echo "</select>";
            }
            ?></p>
            <input type="submit" value="Enviar">
    </form>
</body>
</html>