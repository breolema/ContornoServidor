<?php
session_start();
if(isset($_POST["tarefa"])){
    $tarefa=$_POST["tarefa"];
}

if(isset($_SESSION["tarefas"])){
    $tarefas = ($_SESSION["tarefas"]); 
} else {
    $tarefas = array();
}

if (isset($_POST["tarefa"]) && !empty($_POST["tarefa"])) {
    $tarefa = $_POST["tarefa"];
    array_push($tarefas,$tarefa);
    $_SESSION["tarefas"] = $tarefas;
}

if(isset($_GET["borrar"])){
    $borrarTareas=$_GET["borrar"];
    array_splice($tarefas,$borrarTareas,1); //para borrar o indice da tarea usando $borrarTareas
    $_SESSION["tarefas"] = $tarefas;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Exercicio4</title>
</head>
<body>
<form method="post" action="practica4-sesions.php">
        <p>Engadir tarefa: <input type="text" name="tarefa"></p>
        <input type="submit" value="Engadir">
</form>
<?php

//Enseñamos la lista de tareas
  if(count($tarefas)>0){ //co count contamos que o array $tarefas teña valores para pintalos
    echo "<h2>Lista de tarefas</h2>";
    //pintamos todos os valores do array, tanto os gardados como os novos que añadimos
    foreach ($tarefas as $idTarea =>$t) {
        echo"<li>$t <a href='practica4-sesions.php?borrar=$idTarea'>Borrar</a></li>";
    }
}
?>

</body>
</html>