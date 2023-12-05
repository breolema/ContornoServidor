<html>
<head>
<title>Exercicio6-añadir</title>
</head>
<body>
    <?php
     $conexion=mysqli_connect("localhost","root","","cursos");

     $id=$_GET["id"];

     $sql="UPDATE cursos SET plazas_ocupadas=(plazas_ocupadas+1) WHERE id_curso=$id";
     $result = $conexion->query($sql);

     header("Location:Exercicio6-index.php");

?>

</body>
</html>