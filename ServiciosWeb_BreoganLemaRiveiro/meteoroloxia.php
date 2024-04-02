<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meteoroloxía</title>
    <link rel="stylesheet" href="css/comun.css">
</head>

<body>
    <nav>
        <img src="Escudo_de_Cee.svg" alt="logo">
        <a href="index.html">Inicio</a>
        <a href="meteoroloxia.php">Meteoroloxia Cee</a>
    </nav>
    <?php
    //URL da API de WorldTime para obter a hora actual en España
    $urlHora='http://worldtimeapi.org/api/timezone/Europe/Madrid';

    //Solicitude GET a API de WorldTime
    $respostaHora=file_get_contents($urlHora);

    //Decodificar a resposta JSON
    $datosHora=json_decode($respostaHora, true);

    //URL da API de OpenWeatherMap para obter o tempo en Cee
    $urlTempo='http://api.openweathermap.org/data/2.5/weather?q=Cee&appid=b43aa0983fa1c4997b28801b6afc4bb1&units=metric';

    //Solicitude GET a API de OpenWeatherMap
    $respostaTempo=file_get_contents($urlTempo);

    //Decodificar a resposta JSON
    $datosTempo=json_decode($respostaTempo, true);

    //Verificar si se ven os datos
    if ($datosHora && isset($datosHora['datetime']) && $datosTempo && isset($datosTempo['main'])) {
        $horarioCee=new DateTime($datosHora['datetime']);
        $horaCee=$horarioCee->format('H:i:s'); // Formato de hora (HH:MM:SS)
        $fechaCee=$horarioCee->format('d/m/Y'); // Formato de fecha (DD/MM/AAAA)
    
        //Hora en Cee
        $cee_hora=date('H:i:s');
        //Fecha en Cee
        $cee_fecha=date('d/m/Y');
        //Mostrar fecha e hora
        echo "<h1>Hora e fecha actual en Cee:</h1>";
        echo "<p>$horaCee</p>";
        echo "<p>$fechaCee</p>";

        //Mostrar tempo en Cee
        echo "<h1>Condicions meteorolóxicas actuais en Cee:</h1>";
        echo "<p>Temperatura: " . $datosTempo['main']['temp'] . "°C</p>";
        echo "<p>Tiempo: " . $datosTempo['weather'][0]['description'] . "</p>";
        echo "<p>Vento: " . $datosTempo['wind']['speed'] . " m/s</p>";
        echo "<p>Humidade: " . $datosTempo['main']['humidity'] . "%</p>";
    } else {
        echo "Non se puideron obter datos.";
    }
    ?>



    <footer style="position: absolute">
        <div>
            <p style="font-size: 16px;">Dereitos de autor © 2024 - Todos os dereitos reservados.</p>
            <p style="font-size: 16px;">Desenvolvido por Breogan Lema Industrias</p>
        </div>
    </footer>
</body>

</html>