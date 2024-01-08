<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Categoria Subcategoria PHp & MySQL</title>
</head>

<body>
<?php 
include_once("config.php");
include_once("funciones.php");
$categories = categories(); ?>
<?php foreach($categories as $category){ ?>
		<ul class="category">
			<li><?php echo $category['categoria_nombre'] ?></li>
		<?php 
			if( ! empty($category['subcategory'])){
				echo viewsubcat($category['subcategory']);
			} 
		?>
	</ul>
<?php } ?>
</body>
</html>