<?php
    session_start();
    $conexion=mysqli_connect("localhost","root","","geografia");
    
    $localidad=$_SESSION["$localidad"];

    $provincia = $_SESSION["provincias"];

    $sql="SELECT provincias.nombre from provincias join localidades where provincias.n_provincia=(SELECT )";
?>

<html>
<head>
<title>Exercicio5-index</title>
</head>
<body>
    
</body>
</html>