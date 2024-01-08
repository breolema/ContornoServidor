<?php
/* IMPORTANTE:
Os ficheiros de descarga de datos que se usan, relativos as praias de Gijon, cambiaron.
e por tanto, a estructura do ficheiro local que temos non coincide coa estructura do 
ficheiro que se utiliza on line
*/
/* No código, para non ter que duplicar todo, comentar ou ben a parte do ficheiro
local, ou ben, comentar a parte de consultar on line e probar
*/
/* hai que adaptar o nome dos campos que temos no ficheiro online/ou local
para que interprete correctamente o que ten que ler, por por une xemplo,
no ficheiro local, espera recibir a dirección da foto que represnta a imagen da praia
nun campo foto, e recibeo nun campo imaxen, e viceversa.
¡¡ adtaptar os cabmios para que se lea ben ¡¡
*/

define('XML', 'https://opendata.gijon.es/descargar.php?id=749&tipo=XML');
define('XMLlocal', 'playas.xml'); 

if($data = simplexml_load_file(XML)){
}
else{
	$data = simplexml_load_file(XMLlocal);
}

?>

<html>
<h1>Playas de Gijón</h1>

<?php
	//bucle para recorrer los elementos del array
	foreach($data as $item){
?>
	<table border="1">
		<tr>
			<td>Nombre: </td>
			<td>
				<?php echo $item->nombre; ?>	
			</td>
		</tr>
		<tr>
			<td>URL: </td>
			<td>
				<?php echo $item->url; ?>
			</td>
		</tr>
		<tr>
			<td>Descripcion: </td>
			<td>
				<?php echo $item->descripcion; ?>	
			</td>
		</tr>
		<tr>
			<td>Direccion: </td>
			<td>
				<?php echo $item->direccion; ?>	
			</td>
		</tr>
		<tr>
			<td>Foto: </td>
			<td>
				<?php echo '<img src="' . $item->imagen . '"/>'; ?>
			</td>
		</tr>
		<tr>
			<td>Localizacion: </td>
			<td>
				<?php echo '<a href="https://www.google.com/maps/place/' . $item->localizacion . '">' . $item->localizacion . '</a>'; ?>
			</td>
		</tr>
	</table><br />
<?php 
	} //cerramos bucle
?>

</html>