<!-- html/Lista_Productos.php -->

<?php $p = $this->Productos ?>

<!DOCTYPE html>
<html>
<head>
	<title>Detalle_Productos</title>

	<style>
		body {
			background-color: #AED6F1;
			margin-left: 0px;
			margin-right: 0px;
		}

		.NAVEGACION nav{
			background-color: #EBF5FB;
			text-align: center;
			padding-top: 6px;
			padding-bottom: 6px;
			zoom: 150%;
		}

		.ITEM_NAVEGACION a {
			background-color: #AED6F1;
			border-radius: 5px;
			padding-top: 4px;
			padding-bottom: 4px;
			padding-left: 4px;
			padding-right: 4px;
			margin-left: 3px;
			margin-right: 3px;
			text-decoration: none;
		}

		.ITEM_PRODUCTOS {
			text-align: center;
			background-color: #ebf5fb;
			border-radius: 10px;
			padding: 20px;
		}

		.ITEM_PRODUCTO_IMAGE {
			width: 400px;
			height: 500px;
		}

		.ITEM_PRODUCTO {
			display: inline-block;
  			width: 130px;
			text-align: center;
		}

		#Nombre_Producto {
			font-weight: bold;
		}

		#Descripcion_Producto {
			font-weight: bold;
		}

		#Precio_Producto {
			font-weight: bold;
		}


	</style>


</head>
<body>
<header>
	<div class= "NAVEGACION">
		<nav>
			<?php foreach($this->Navegacion as $n) { ?>
				<span class="ITEM_NAVEGACION"><a href="<?= $n["Path"] ?>"><?= $n["Name"] ?></a>
			</span>
			<?php } ?>
		</nav>
	</div>
</header>

	<h1>Producto <?= $p['Nombre'] ?></h1>
	
	<div class= "ITEM_PRODUCTOS">
			<img src="<?= $p['Image'] ?>" alt="<?= $p['Nombre'] ?>" class="ITEM_PRODUCTO_IMAGE" >
			<p id="Nombre_Producto" class="ITEM_PRODUCTO_INFO"><?= $p['Nombre'] ?></p>
			<p id="Descripcion_Producto" class="ITEM_PRODUCTO_INFO"><?= $p['Descripcion'] ?></p>
			<p id="Precio_Producto" class="ITEM_PRODUCTO_INFO"><?= '$' . $p['Precio'] ?></p>
			<span class="ITEM_PRODUCTO">
				<p class="ITEM_PRODUCTO_INFO">Alto: <?= $p['Alto'] ?></p>
			</span>
			<span class="ITEM_PRODUCTO">
			<p class="ITEM_PRODUCTO_INFO">Ancho: <?= $p['Ancho'] ?></p>
			</span>
			<span class="ITEM_PRODUCTO">
			<p class="ITEM_PRODUCTO_INFO">Largo: <?= $p['Largo'] ?></p>
			</span>
			<span class="ITEM_PRODUCTO">
			<p class="ITEM_PRODUCTO_INFO">Stock: <?= $p['Stock'] ?></p>
			</span>
			</span>
			<span class="ITEM_PRODUCTO">
			<p class="ITEM_PRODUCTO_INFO">Categoria: <?= $p['Descripcion_Categoria'] ?></p>
			</span>
			</span>
			<span class="ITEM_PRODUCTO">
			<p class="ITEM_PRODUCTO_INFO">Material: <?= $p['Descripcion_Material'] ?></p>
			</span>
			</span>
			<span class="ITEM_PRODUCTO">
			<p class="ITEM_PRODUCTO_INFO">Color: <?= $p['Descripcion_Color'] ?></p>
			</span>
	</div>
		
</body>
</html>