<?php
//comprobamos si mandan datos por POSR
if(isset($_POST["tarefa"])){
    $tarefa=$_POST["tarefa"];
}
//comprobamos si hai COOKIES no sistema
 if (isset($_COOKIE["tarefas"])) {
    $tarefas = unserialize($_COOKIE["tarefas"]); //unserialize() puede restaurar los valores originales a partir de dicho string
} else {
    $tarefas = array();
}

//comprobamos que se mandan datos, e que non esta vacio, unha vez feito esto
//mandamos os datos que se añadiron ($tarefa) o array ($tarefas)
if (isset($_POST["tarefa"]) && !empty($_POST["tarefa"])) {
    $tarefa = $_POST["tarefa"];
    array_push($tarefas,$tarefa);
    setcookie("tarefas", serialize($tarefas), time() + (24 * 60 * 60));
    //serialize() devuelve un string
}


//Borrado dos datos que queiramos
if(isset($_GET["borrar"])){
    $borrarTareas=$_GET["borrar"];
    array_splice($tarefas,$borrarTareas,1); //para borrar o indice da tarea usando $borrarTareas
    //grabar o array actual e actualizar as cookies
    setcookie("tarefas", serialize($tarefas));
    $_COOKIE["tarefas"] = serialize($tarefas);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Exercicio4</title>
</head>
<body>
<form method="post" action="practica4-index.php">
        <p>Engadir tarefa: <input type="text" name="tarefa"></p>
        <input type="submit" value="Engadir">
</form>
<?php

//Enseñamos la lista de tareas
  if(count($tarefas)>0){ //co count contamos que o array $tarefas teña valores para pintalos
    echo "<h2>Lista de tarefas</h2>";
    //pintamos todos os valores do array, tanto os gardados como os novos que añadimos
    foreach ($tarefas as $idTarea =>$t) {
        echo"<li>$t <a href='practica4-index.php?borrar=$idTarea'>Borrar</a></li>";
    }
}


?>

</body>
</html>