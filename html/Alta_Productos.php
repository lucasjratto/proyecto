<!-- html/Lista_Productos.php -->

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

		.ALTA_PRODUCTOS {
			text-align: center;
			background-color: #ebf5fb;
			border-radius: 10px;
			padding: 20px;
		}

		label {
			display: block;
    		text-align: center;
			margin-top: 20px;

		}

		#Alta_Submit {
			margin-top: 20px;

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

	<h1>Alta de Producto</h1>
	
	<div class= "ALTA_PRODUCTOS">
		<form action="" method='post' enctype="multipart/form-data" id="form">
			<div>
				<label for="Nombre">Nombre:</label>
				<input type="text" id="Alta_Nombre" name="Nombre">
				<p id="Alta_Nombre_Alert"></p>
			</div>
			<div>
				<label for="Descripcion">Descripcion:</label>
				<input type="text" id="Alta_Descripcion" name="Descripcion">
				<p id="Alta_Descripcion_Alert"></p>
			</div>
			<div>
				<label for="Precio">Precio:</label>
				<input type="text" id="Alta_Precio" name="Precio">
				<p id="Alta_Precio_Alert"></p>
			</div>
			<div>
				<label for="Alto">Alto:</label>
				<input type="text" id="Alta_Alto" name="Alto">
				<p id="Alta_Alto_Alert"></p>
			</div>
			<div>
				<label for="Ancho">Ancho:</label>
				<input type="text" id="Alta_Ancho" name="Ancho">
				<p id="Alta_Ancho_Alert"></p>
			</div>
			<div>
				<label for="Largo">Largo:</label>
				<input type="text" id="Alta_Largo" name="Largo">
				<p id="Alta_Largo_Alert"></p>
			</div>
			<div>
				<label for="Stock">Stock:</label>
				<input type="text" id="Alta_Stock" name="Stock">
				<p id="Alta_Stock_Alert"></p>
			</div>

			
			<div >
				<label id="Categorias_Label" for="Categorias">Categoria:</label>
				<select name="Categorias" id="Categorias">
					<?php foreach($this->Categorias as $p) { ?>
					<option value="<?=$p["Id_Categoria"]?>"><?=$p["Descripcion"]?></option>
					<?php } ?>
				</select>
			</div>

			<div >
				<label id="Materiales_Label" for="Materiales">Material:</label>
				<select name="Materiales" id="Materiales">
					<?php foreach($this->Materiales as $p) { ?>
					<option value="<?=$p["Id_Material"]?>"><?=$p["Descripcion"]?></option>
					<?php } ?>
				</select>
			</div>

			<div >
				<label id="Colores_Label" for="Colores">Color:</label>
				<select name="Colores" id="Colores">
					<?php foreach($this->Colores as $p) { ?>
					<option value="<?=$p["Id_Color"]?>"><?=$p["Descripcion"]?></option>
					<?php } ?>
				</select>
			</div>

			<div>
				<label for="Image">Imagen:</label>
				<input type="file" id="Alta_Image" name="Image">
			</div>
			
			<input type="submit" value="Alta Producto" id='Alta_Submit'>

		</form>
	</div>
		


	<script>
		"use strict"

		document.getElementById("form").onsubmit = function () {
			var error = 0;
			var Nombre = document.getElementById("Alta_Nombre").value;
			var Descripcion = document.getElementById("Alta_Descripcion").value;
			var Precio = document.getElementById("Alta_Precio").value;
			var Alto = document.getElementById("Alta_Alto").value;
			var Ancho = document.getElementById("Alta_Ancho").value;
			var Largo = document.getElementById("Alta_Largo").value;
			var Stock = document.getElementById("Alta_Stock").value;

			if (Nombre.length < 6 || Nombre.length > 60 ){
				document.getElementById("Alta_Nombre_Alert").innerHTML = "Error al ingresar el Nombre";
				var error = 1;
			}
			 
			if (Descripcion.length < 10 || Descripcion.length > 250 ) {
				document.getElementById("Alta_Descripcion_Alert").innerHTML = "Error al ingresar la Descripcion";
				var error = 1;
			}


			if (isNaN(Precio) || Precio.length <= 0 || Precio < 0 || Precio > 99999999 ) {
				document.getElementById("Alta_Precio_Alert").innerHTML = "Error al ingresar el Precio";
				var error = 1;
			}

			if (isNaN(Alto) || Alto.length <= 0 || Alto < 0 || Alto > 99999999 ) {
				document.getElementById("Alta_Alto_Alert").innerHTML = "Error al ingresar el Alto";
				var error = 1;
			} 

			if (isNaN(Ancho) || Ancho.length <= 0 || Ancho < 0 || Ancho > 99999999 ) {
				document.getElementById("Alta_Ancho_Alert").innerHTML = "Error al ingresar el Ancho";
				var error = 1;
			} 

			if (isNaN(Largo) || Largo.length <= 0 || Largo < 0 || Largo > 99999999 ) {
				document.getElementById("Alta_Largo_Alert").innerHTML = "Error al ingresar el Largo";
				var error = 1;
			} 

			if (isNaN(Stock) || Stock.length <= 0 || Stock < 0 || Stock > 99999999 ) {
				document.getElementById("Alta_Stock_Alert").innerHTML = "Error al ingresar el Stock";
				var error = 1;
			}

			if(error == 1) return false;
		};

		document.getElementById("Alta_Nombre").onclick = function (){
			document.getElementById("Alta_Nombre_Alert").innerHTML = "";
		}

		document.getElementById("Alta_Descripcion").onclick = function (){
			document.getElementById("Alta_Descripcion_Alert").innerHTML = "";
		}

		document.getElementById("Alta_Precio").onclick = function (){
			document.getElementById("Alta_Precio_Alert").innerHTML = "";
		}

		document.getElementById("Alta_Alto").onclick = function (){
			document.getElementById("Alta_Alto_Alert").innerHTML = "";
		}

		document.getElementById("Alta_Ancho").onclick = function (){
			document.getElementById("Alta_Ancho_Alert").innerHTML = "";
		}

		document.getElementById("Alta_Largo").onclick = function (){
			document.getElementById("Alta_Largo_Alert").innerHTML = "";
		}
		
		document.getElementById("Alta_Stock").onclick = function (){
			document.getElementById("Alta_Stock_Alert").innerHTML = "";
		}
	</script>	
</body>
</html>