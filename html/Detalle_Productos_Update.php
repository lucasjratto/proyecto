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

		.UPDATE_PRODUCTOS {
			text-align: center;
			background-color: #ebf5fb;
			border-radius: 10px;
			padding: 20px;
		}

		.ITEM_PRODUCTO_IMAGE {
			width: 300px;
			height: 400px;
		}

		.ITEM_FORM {
			display: inline-block;
  			width: 130px;
			text-align: center;
		}

		.ITEM_FORM input{
			width: 125px;
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
	
	<div class= "UPDATE_PRODUCTOS">
	<img src="<?= $p['Image'] . '?' . rand(0,9999) . '=' . rand(0,9999) ?>" alt="<?= $p['Nombre'] ?>" class="ITEM_PRODUCTO_IMAGE" >
		<form action="" method='post' enctype="multipart/form-data" id="form">
			<span class="ITEM_FORM">
				<label id="Nombre" for="Nombre">Nombre:</label>
				<input type="text" id="Alta_Nombre" name="Nombre" value="<?= $p['Nombre'] ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Descripcion" for="Descripcion">Descripcion:</label>
				<input type="text" id="Alta_Descripcion" name="Descripcion" value="<?= $p['Descripcion'] ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Precio" for="Precio">Precio:</label>
				<input type="text" id="Alta_Precio" name="Precio" value="<?= $p['Precio'] ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Alto" for="Alto">Alto:</label>
				<input type="text" id="Alta_Alto" name="Alto" value="<?= $p['Alto'] ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Ancho" for="Ancho">Ancho:</label>
				<input type="text" id="Alta_Ancho" name="Ancho" value="<?= $p['Ancho'] ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Largo" for="Largo">Largo:</label>
				<input type="text" id="Alta_Largo" name="Largo" value="<?= $p['Largo'] ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Stock" for="Stock">Stock:</label>
				<input type="text" id="Alta_Stock" name="Stock" value="<?= $p['Stock'] ?>">
			</span>

			<span class="ITEM_FORM" >
				<label id="Categorias_Label" for="Categorias">Categoria:</label>
				<select name="Categorias" id="Categorias">
					<?php foreach($this->Categorias as $ca) { ?>
					<option <?php if($p["Id_Categoria"] == $ca["Id_Categoria"]) echo "selected " ?>value="<?=$ca["Id_Categoria"]?>"><?=$ca["Descripcion"]?></option>
					<?php } ?>
				</select>
			</span>

			<span class="ITEM_FORM" >
				<label id="Materiales_Label" for="Materiales">Material:</label>
				<select name="Materiales" id="Materiales">
					<?php foreach($this->Materiales as $ma) { ?>
					<option <?php if($p["Id_Material"] == $ma["Id_Material"]) echo "selected " ?>value="<?=$ma["Id_Material"]?>"><?=$ma["Descripcion"]?></option>
					<?php } ?>
				</select>
			</span>

			<span class="ITEM_FORM" >
				<label id="Colores_Label" for="Colores">Color:</label>
				<select name="Colores" id="Colores">
					<?php foreach($this->Colores as $co) { ?>
					<option <?php if($p["Id_Color"] == $co["Id_Color"]) echo "selected " ?>value="<?=$co["Id_Color"]?>"><?=$co["Descripcion"]?></option>
					<?php } ?>
				</select>
			</span>

			<span class="ITEM_FORM_SUBMIT">
				<label id="Image" for="Image">Imagen:</label>
				<input type="file" id="Alta_Image" name="Image" value="<?= $p['Image'] ?>">
			</span>
			<div class="ITEM_FORM_SUBMIT">
				<input type="submit" value="Modificar Producto" name="Modificar_Producto" id='Modificar_Submit'>
			</div>
			<div class="ITEM_FORM_SUBMIT">
				<input type="submit" value="Eliminar Producto" name="Eliminar_Producto" id='Eliminar_Submit'>
			</div>
		</form>
	</div>


	<script>
		"use strict"
		
		document.getElementById("Alta_Nombre").onkeyup = function () {
			var Nombre = document.getElementById("Alta_Nombre").value;

			if (Nombre.length < 6 || Nombre.length > 60 ){
				document.getElementById("Nombre").style.color = "red";
			}
			else {
				document.getElementById("Nombre").style.color = "";
			}
		}

		document.getElementById("Alta_Descripcion").onkeyup = function () {
			var Descripcion = document.getElementById("Alta_Descripcion").value;

			if (Descripcion.length < 10 || Descripcion.length > 250 ) {
				document.getElementById("Descripcion").style.color = "red";
			}
			else {
				document.getElementById("Descripcion").style.color = "";
			}
		}

		document.getElementById("Alta_Precio").onkeyup = function () {
			var Precio = document.getElementById("Alta_Precio").value;

			if (isNaN(Precio)){
				document.getElementById("Precio").style.color = "red";
			}
			if (!isNaN(Precio)){
				document.getElementById("Precio").style.color = "";
			}
		}

		document.getElementById("Alta_Alto").onkeyup = function () {
			var Alto = document.getElementById("Alta_Alto").value;

			if (isNaN(Alto)){
				document.getElementById("Alto").style.color = "red";
			}
			if (!isNaN(Alto)){
				document.getElementById("Alto").style.color = "";
			}
		}

		document.getElementById("Alta_Ancho").onkeyup = function () {
			var Ancho = document.getElementById("Alta_Ancho").value;

			if (isNaN(Ancho)){
				document.getElementById("Ancho").style.color = "red";
			}
			if (!isNaN(Ancho)){
				document.getElementById("Ancho").style.color = "";
			}
		}

		document.getElementById("Alta_Largo").onkeyup = function () {
			var Largo = document.getElementById("Alta_Largo").value;

			if (isNaN(Largo)){
				document.getElementById("Largo").style.color = "red";
			}
			if (!isNaN(Largo)){
				document.getElementById("Largo").style.color = "";
			}
		}

		document.getElementById("Alta_Stock").onkeyup = function () {
			var Stock = document.getElementById("Alta_Stock").value;

			if (isNaN(Stock)){
				document.getElementById("Stock").style.color = "red";
			}
			if (!isNaN(Stock)){
				document.getElementById("Stock").style.color = "";
			}
		}

		document.getElementById("form").onsubmit = function () {
			var Nombre = document.getElementById("Alta_Nombre").value;
			var Descripcion = document.getElementById("Alta_Descripcion").value;
			var Precio = document.getElementById("Alta_Precio").value;
			var Alto = document.getElementById("Alta_Alto").value;
			var Ancho = document.getElementById("Alta_Ancho").value;
			var Largo = document.getElementById("Alta_Largo").value;
			var Stock = document.getElementById("Alta_Stock").value;

			if ( Descripcion.length < 10 || Descripcion.length > 250 || Nombre.length < 6 || Nombre.length > 60 || isNaN(Precio) || isNaN(Alto) || isNaN(Ancho) || isNaN(Largo) || isNaN(Stock) ){
				alert("No se pudo realizar la modificación, compruebe los valores ingresados")
				return false
			}
		}





	</script>


</body>
</html>