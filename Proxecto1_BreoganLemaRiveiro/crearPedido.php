<?php
    session_start();

    if (!isset($_SESSION["usuario"])) {
       header("Location: inicioSesion.php");
       exit;
   }

   $conexion = mysqli_connect("localhost", "root", "", "supermercado");

   if (isset($_SESSION["arrayCarrito"]) && !empty($_SESSION["arrayCarrito"])) {
    $arrayCarrito = $_SESSION["arrayCarrito"];
} else {
    header("Location: carrito.php");
    exit;
}

foreach ($arrayCarrito as $producto) {
    $codProducto = $producto['codprod'];
    $unidadesPedido = $producto['cantidad'];

    $comprobarStock = "SELECT stock FROM productos WHERE CodProd = $codProducto";
    $resultComprStock = $conexion->query($comprobarStock);

    if($resultComprStock->num_rows > 0) {
        $filaStock = $resultComprStock -> fetch_assoc();
        $stockDisponible = $filaStock['stock'];
        if ($stockDisponible < $unidadesPedido) {
            //mensaxe
            exit;
        }
    } else {
        //mensaxe si non se pode acceder o stock
        exit;
    }
}

$fecha = date('d-m-Y');
$usuarioActual = $_SESSION["usuario"];
$sqlUserActual = "SELECT CodUsu FROM usuarios WHERE Nombre='$usuarioActual'";

?>