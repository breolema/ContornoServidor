<?php
session_start();

if (!isset($_SESSION["usuario"])) {
  header("Location: inicioSesion.php");
  exit;
}

//referencia
use Dompdf\Dompdf;

$conexion = mysqli_connect("localhost", "root", "", "supermercado");

$codPedido = $_POST["codigoPedido"];

$sqlInfoPedido = "SELECT pedidos.CodPed AS CodigoPedido, pedidos.Fecha AS Fecha, pedidos.PrecioTotal AS PrecioTotal, usuarios.Nombre AS NombreCliente, usuarios.Correo AS EmailCliente
                FROM pedidos
                INNER JOIN estadoPedido ON pedidos.CodEstado = estadoPedido.CodEstadoPedido
                INNER JOIN usuarios ON pedidos.CodUsuario = usuarios.CodUsu
                WHERE pedidos.CodPed = '$codPedido'";
$resultInfoPedido = $conexion->query($sqlInfoPedido);

$mihtml = '<h1>Detalles del Pedido</h1>';

if ($resultInfoPedido->num_rows > 0) {
  while ($fila = $resultInfoPedido->fetch_assoc()) {
    $mihtml .= '<p><strong>Código de Pedido:</strong> ' . $fila['CodigoPedido'] . '</p>';
    $mihtml .= '<p><strong>Fecha:</strong> ' . $fila['Fecha'] . '</p>';
    $mihtml .= '<p><strong>Nombre del Cliente:</strong> ' . $fila['NombreCliente'] . '</p>';
    $mihtml .= '<p><strong>Email del Cliente:</strong> ' . $fila['EmailCliente'] . '</p>';
    $mihtml .= '<p><strong>Precio Total:</strong> ' . $fila['PrecioTotal'] . '€</p>';
  }
}

$mihtml .= '<table border=1>';
$mihtml .= '<thead>';
$mihtml .= '<tr>';
$mihtml .= '<th>Nombre del Producto</th>';
$mihtml .= '<th>Cantidad</th>';
$mihtml .= '<th>Precio</th>';
$mihtml .= '</tr>';
$mihtml .= '</thead>';
$mihtml .= '<tbody>';

$sqlDetallesProductos = "SELECT productos.Nombre AS NombreProducto, pedidosproductos.Unidades AS Cantidad, productos.Precio AS PrecioProducto
                        FROM pedidosproductos
                        INNER JOIN productos ON pedidosproductos.CodProd = productos.CodProd
                        WHERE pedidosproductos.CodPed = '$codPedido'";
$resultDetallesProductos = $conexion->query($sqlDetallesProductos);

if ($resultDetallesProductos->num_rows > 0) {
  while ($filaProducto = $resultDetallesProductos->fetch_assoc()) {
    $mihtml .= '<tr>';
    $mihtml .= '<td>' . $filaProducto['NombreProducto'] . '</td>';
    $mihtml .= '<td>' . $filaProducto['Cantidad'] . '</td>';
    $mihtml .= '<td>' . $filaProducto['PrecioProducto'] . '</td>';
    $mihtml .= '</tr>';
  }
}

$mihtml .= '</tbody>';
$mihtml .= '</table>';

require_once("vendor/autoload.php");

//Creando instancia para generar PDF
$dompdf = new DOMPDF();

// Cargar el HTML
$dompdf->load_html('<h1 style="text-align: center;">Pedido nº' . $codPedido . '</h1>' . $mihtml);

//Renderizar o html
$dompdf->render();

//Exibibir nombre de archivo
$dompdf->stream(
  "Pedido nº" . $codPedido ,
  array(
    "Attachment" => true //Para realizar la descarga
  )
);
?>
