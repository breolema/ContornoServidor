<html>
<head>
<title>Exercicio1_1</title>
</head>
<body>
    <form action="Exercicio1_2.php" method="GET">
        <p>Elija la comunidad deseada 
            <?php 
            $conexion=mysqli_connect("localhost","root","","geografia");  
            $sql= "SELECT NOMBRE FROM COMUNIDADES";
            $result = $conexion->query($sql);

                echo "<select id='comunidades' name='comunidades'>";
                while($row = $result->fetch_assoc()) {
                    echo "<option value=" .  $row["NOMBRE"] .">" . $row["NOMBRE"] . "</option>";
                }
                echo "</select>";
            ?></p>
            <input type="submit" value="Enviar">
    </form>
</body>
</html>
