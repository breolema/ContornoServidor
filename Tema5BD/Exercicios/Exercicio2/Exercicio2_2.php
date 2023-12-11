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
            

            $sql= "SELECT LOCALIDADES.NOMBRE, POBLACION FROM LOCALIDADES  JOIN PROVINCIAS ON PROVINCIAS.N_PROVINCIA=LOCALIDADES.N_PROVINCIA WHERE UPPER(PROVINCIAS.NOMBRE) = '$provincia'";
            $result = $conexion->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1>Localidades de $provincia</h1>";

                if(isset($_GET["pg"])) {
                    $pg = $_GET["pg"]; //se na chamada xa me ven o valor de PG, alamcenao 
                    if($pg<=0 || is_numeric($pg)==false) $pg=1; //sería o caso de chegar a esta páxina sen vir de refrescar datos.
                }
                else
                    $pg=1;
                 //*******preparación da barra de paxinación
            //variable coa  parte común dos enlaces, falta calcular
            //a páxina para cada un deles

            $direccion="Exercicio2_2.php?provincia=$provincia&pg=";
            echo "<p class='pagina'>Página: ";

            if($pg>1)
                //botón da paxina anterior, símbolo <
                echo "<a href='$direccion".($pg-1)."'>&lt;</a>";//uso entidades para representar o <

            $total_pg=(int)($result->num_rows/25+1);//cálculo do total das paxinas, divido os resultados da select entre 25.
            //botons para ir a unha páxina concreta


            for($i=1;$i<=$total_pg;$i++){
                if($i==$pg) //para que a paxina na que estou siguado se amose marcada...
                    echo " <span class='paginaActual'>$i</span> ";
                else
                    echo "<a href='$direccion".$i."'>$i </a>";
            }
            if($pg<$total_pg)
                //botón da páxina seguinte, símbolo >
                echo "<a href='$direccion".($pg+1)."'>&gt;</a>";
            echo "</p>";

            $posicion=($pg-1)*25;
            $result->data_seek($posicion);



            $cont=1;
            $fila=$result->fetch_assoc();//desprazase rexistro a rexistro, dende a posicion marcada anteriormente
            echo "<table border=1><tr><th>Localidad</th>".
                 "<th>Población</th></tr>";
            while($fila && $cont<=25){  //so pinta os 25 primeiros rexistros.
                echo "<tr><td>" . $fila['NOMBRE'] . "</td>";
                echo "<td>" . $fila['POBLACION'] . "habitantes</td>";
                $fila=$result->fetch_assoc();
                $cont++;
            }
            echo "</table>";
            }

        } else {
            header("Location:Exercicio2_1.html");
        }


    ?>
</body>
</html>