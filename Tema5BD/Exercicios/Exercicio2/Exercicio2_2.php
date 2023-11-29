<html>
<head>
<title>Exercicio2_2</title>
</head>
<body>
    <?php
     $conexion=mysqli_connect("localhost","root","","geografia");

        if(isset($_GET['provincia'])==true){
            $provincia=$_GET['provincia'];
            $provincia=strtoupper($provincia);
            echo "<h1>Localidades de $provincia</h1>";

            $sql= "SELECT LOCALIDADES.NOMBRE, POBLACION FROM LOCALIDADES  JOIN PROVINCIAS ON PROVINCIAS.N_PROVINCIA=LOCALIDADES.N_PROVINCIA WHERE UPPER(PROVINCIAS.NOMBRE) = '$provincia'";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                echo "<table border=1>";
                echo "<tr><th>Localidad</th><th>Población</th></tr>";
                while($row = $result->fetch_assoc()) {
                    echo " <tr><td>" . $row["NOMBRE"] . "</td><td>" . $row["POBLACION"] . "</td></tr>";
                }
                echo "</table>";
            }

        } else {
            header("Location:Exercicio2_1.html");
        }


    ?>
</body>
</html>