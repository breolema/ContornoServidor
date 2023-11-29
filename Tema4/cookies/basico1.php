<?php
//abrir inspeccion de paxina web para vela contro+shift+i ou f12
// Chegou o formulario
if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    // Creamos unha cookie que expirará en 30 días
    setcookie('nome_usuario', $nome, time() + 30 * 24 * 60 * 60);
} else if (isset($_COOKIE['nome_usuario'])) {
    // Si a cookie xa existe, recuperamos o nome do usuario
    $nome = $_COOKIE['nome_usuario'];
} else {
    $nome = '';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exemplo de uso de cookies en PHP</title>
</head>
<body>
    <h1>Benvido <?php echo $nome; ?></h1>
    
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>">
        <input type="submit" value="Gardar">
    </form>
</body>
</html>