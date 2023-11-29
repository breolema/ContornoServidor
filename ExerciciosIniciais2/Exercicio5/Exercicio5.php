<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio 5</title>

</head>
<body>

   <?php
       $nombre = $_POST['nombre'];
       $apelido1 = $_POST['apelido1'];
       $apelido2 = $_POST['apelido2'];
       $username = $_POST['username'];
       $identificador = $_POST['identificador'];
       $telefono = $_POST['telefono'];

        $letra = array (
            0 => "T",
            1 =>"R",
            2 => "W",
            3 => "A",
            4 => "G",
            5 => "M",
            6 => "Y",
            7 => "F",
            8 => "P",
            9 => "D",
            10 => "X",
            11 => "B",
            12 => "N",
            13 => "J",
            14 => "Z",
            15 => "S",
            16 => "Q",
            17 => "V",
            18 => "H",
            19 => "L",
            20 =>"C",
            21 => "K",
            22 =>"E"
        );

        $caractNomAp = '/^[a-zA-ZáéíóúüÁÉÍÓÚÜ\s-]+$/';
        $caractUserName = '/^[a-zA-Z][a-zA-Z0-9]{6, }$/';
        $caractIdent = '/^[0-9XYZ][0-9]{7}[A-Z]+$/';
        $caractTelef = '/^[0-9]{9}$/';

        if (!preg_match($caractNomAp, $nombre)) {
            echo "Error: El nombre debe contener solo letras, espacios y guiones! <br>";
        }

        if (!preg_match($caractNomAp, $apelido1)) {
            echo "Error: El primer apellido debe contener solo letras, espacios y guiones!<br>";
        }

        if (!preg_match($caractNomAp, $apelido2)) {
            echo "Error: El segundo apellido debe contener solo letras, espacios y guiones!<br>";
        }
        
        if (!preg_match($caractIdent, $identificador)) {
            echo "Error: El DNI o NIE no cumple el formato!<br>";
        } else {
            if ($identificador[0]=="X") $identificador[0]='0';
            elseif ($identificador[0]=="Y") $identificador[0]='1';
            elseif ($identificador[0]=="Z") $identificador[0]='2';
            $numerosNIF = substr($identificador,0,8);
            $resto = $numerosNIF%23;
            if($identificador[8]!=$letra[$resto]){
                echo "La letra es incorrecta";
            } else {
                echo "El DNI es correcto!";
            }
        }

        if (!preg_match($caractTelef, $telefono)) {
            echo "Error: El numero de teléfono no es válido<br>";
        }

        echo "<p><a href='Exercicio5.html'>Volver o formulario</a></p>";

   ?>
    
</body>
</html>