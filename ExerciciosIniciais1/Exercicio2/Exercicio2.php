<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <title> Exercicio2</title>
</head>
<body>

<?php
    print "<p>Su nombre es " . $_REQUEST["nombre"] . "</p>\n";
    print "<p>Su(s) apellido(s) es/son " . $_REQUEST["apelidos"] . "</p>\n";
    print "<p>Tiene " . $_REQUEST["edad"] . " años</p>\n";
    $subidaSalario=0;
    $salarioFinal=0;
    
    if ($_REQUEST["salario"]>1000 && $_REQUEST["salario"]<=2000 && $_REQUEST["edad"]<=45){
        $subidaSalario=$_REQUEST["salario"]*0.1;
        $salarioFinal=$_REQUEST["salario"]+$subidaSalario;
        print "<p>El salario final es de " . $salarioFinal . "€.";
    } else if ($_REQUEST["salario"]>1000 && $_REQUEST["salario"]<=2000 && $_REQUEST["edad"]>45){
        $subidaSalario=$_REQUEST["salario"]*0.03;
        $salarioFinal=$_REQUEST["salario"]+$subidaSalario;
        print "<p>El salario final es de " . $salarioFinal . "€.";
    } else if ($_REQUEST["salario"]<=1000 && $_REQUEST["edad"]<=30){
        $salarioFinal=1100;
        print "<p>El salario final es de " . $salarioFinal . "€.";
    } else if ($_REQUEST["salario"]<=1000 && $_REQUEST["edad"]>30 && $_REQUEST["edad"]<=45){
        $subidaSalario=$_REQUEST["salario"]*0.03;
        $salarioFinal=$_REQUEST["salario"]+$subidaSalario;
        print "<p>El salario final es de " . $salarioFinal . "€.";
    } else if ($_REQUEST["salario"]<=1000 && $_REQUEST["edad"]>45){
        $subidaSalario=$_REQUEST["salario"]*0.15;
        $salarioFinal=$_REQUEST["salario"]+$subidaSalario;
        print "<p>El salario final es de " . $salarioFinal . "€.";
    } else {
        print "<p>El salario es de " . $_REQUEST["salario"] . "€.";
    }
?>

</body>
</html>