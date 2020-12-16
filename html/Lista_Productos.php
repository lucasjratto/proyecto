<!-- html/Lista_Productos.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Productos</title>

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

		.ITEM_FORM {
			display: inline-block;
  			width: 130px;
			text-align: center;
		}

		.ITEM_FORM input{
			width: 125px;
		}

		.BUSQUEDA_PRODUCTOS {
			background-color: #EBF5FB;
			text-align: center;
			margin-top: 15px;
			margin-bottom: 15px;
			padding-top: 15px;
			padding-bottom: 15px;
		}

		.LISTA_PRODUCTOS {
			display: grid;
  			grid-gap: 1rem;
			padding-right: 50px;
			padding-left: 50px;
  			grid-template-columns: 400px 400px 400px 400px;
		}

		.ITEM_PRODUCTO_IMAGE {
			width: 300px;
			height: 400px;
		}
		
		.ITEM_PRODUCTOS {
			text-align: center;
			background-color: #ebf5fb;
			border-radius: 10px;
			padding: 20px;
		}

		h1 {
			zoom: 70%;

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

	<h1>Productos</h1>
	
	<div class= "BUSQUEDA_PRODUCTOS">
		<form action="" method='get' id="form">
			<span class="ITEM_FORM">
				<label for="Nombre">Nombre:</label>
				<input type="text" id="Alta_Nombre" name="Nombre" value="<?= $this->Old_Nombre ?>">
			</span>
			<span class="ITEM_FORM">
				<label for="Descripcion">Descripcion:</label>
				<input type="text" id="Alta_Descripcion" name="Descripcion" value="<?= $this->Old_Descripcion ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Precio_Max_Label" for="Precio_Max">Precio Max:</label>
				<input type="text" id="Precio_Max" name="Precio_Max" value="<?= $this->Old_Precio_Max ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Precio_Min_Label" for="Precio_Min">Precio Min:</label>
				<input type="text" id="Precio_Min" name="Precio_Min" value="<?= $this->Old_Precio_Min ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Alto_Max_Label" for="Alto_Max">Alto Max:</label>
				<input type="text" id="Alto_Max" name="Alto_Max" value="<?= $this->Old_Alto_Max ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Alto_Min_Label" for="Alto_Min">Alto Min:</label>
				<input type="text" id="Alto_Min" name="Alto_Min" value="<?= $this->Old_Alto_Min ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Ancho_Max_Label" for="Ancho_Max">Ancho Max:</label>
				<input type="text" id="Ancho_Max" name="Ancho_Max" value="<?= $this->Old_Ancho_Max ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Ancho_Min_Label" for="Ancho_Min">Ancho Min:</label>
				<input type="text" id="Ancho_Min" name="Ancho_Min" value="<?= $this->Old_Ancho_Min ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Largo_Max_Label" for="Largo_Max">Largo Max:</label>
				<input type="text" id="Largo_Max" name="Largo_Max" value="<?= $this->Old_Largo_Max ?>">
			</span>
			<span class="ITEM_FORM">
				<label id="Largo_Min_Label" for="Largo_Min">Largo Min:</label>
				<input type="text" id="Largo_Min" name="Largo_Min" value="<?= $this->Old_Largo_Min ?>">
			</span>

			<span class="ITEM_FORM">
				<label id="Categorias_Label" for="Categorias">Categoria:</label>
				<select name="Categorias" id="Categorias">
					<?php foreach($this->Categorias as $p) { ?>
					<option <?php if($this->Old_Categoria == $p["Id_Categoria"]) echo "selected " ?>value="<?=$p["Id_Categoria"]?>"><?=$p["Descripcion"]?></option>
					<?php } ?>
				</select>
			</span>

			<span class="ITEM_FORM">
				<label id="Materiales_Label" for="Materiales">Material:</label>
				<select name="Materiales" id="Materiales">
					<?php foreach($this->Materiales as $p) { ?>
					<option <?php if($this->Old_Material == $p["Id_Material"]) echo "selected " ?>value="<?=$p["Id_Material"]?>"><?=$p["Descripcion"]?></option>
					<?php } ?>
				</select>
			</span>

			<span class="ITEM_FORM">
				<label id="Colores_Label" for="Colores">Color:</label>
				<select name="Colores" id="Colores">
					<?php foreach($this->Colores as $p) { ?>
					<option <?php if($this->Old_Color == $p["Id_Color"]) echo "selected " ?>value="<?=$p["Id_Color"]?>"><?=$p["Descripcion"]?></option>
					<?php } ?>
				</select>
			</span>

			<span class="ITEM_FORM">
				<input type="submit" value="Buscar" id='Buscar_Submit'>
			</span>
				
			
		</form>
	</div>

	<div class= "LISTA_PRODUCTOS">
	<?php foreach($this->Productos as $p) { ?>
		<div class= "ITEM_PRODUCTOS">
			<a href="<?= $this->Detalle_Producto_Path . $p['Id_Producto'] ?>">
				<img src="<?= $p['Image'] ?>" alt="<?= $p['Nombre'] ?>" class="ITEM_PRODUCTO_IMAGE" >
			</a>
			<p class="ITEM_PRODUCTO_NOMBRE"><?= $p['Nombre'] ?></p>
			<p class="ITEM_PRODUCTO_NOMBRE"><?= '$' .$p['Precio'] ?></p>
			
			
		</div>
	<?php } ?>
	

	<script>
		"use strict"
		document.getElementById("Precio_Max").onkeyup = function () {
			var Precio = document.getElementById("Precio_Max").value;

			if (isNaN(Precio)){
				document.getElementById("Precio_Max_Label").style.color = "red";
			}
			if (!isNaN(Precio)){
				document.getElementById("Precio_Max_Label").style.color = "";
			}
		}

		document.getElementById("Precio_Min").onkeyup = function () {
			var Precio = document.getElementById("Precio_Min").value;

			if (isNaN(Precio)){
				document.getElementById("Precio_Min_Label").style.color = "red";
			}
			if (!isNaN(Precio)){
				document.getElementById("Precio_Min_Label").style.color = "";
			}
		}

		document.getElementById("Alto_Max").onkeyup = function () {
			var Alto = document.getElementById("Alto_Max").value;

			if (isNaN(Alto)){
				document.getElementById("Alto_Max_Label").style.color = "red";
			}
			if (!isNaN(Alto)){
				document.getElementById("Alto_Max_Label").style.color = "";
			}
		}

		document.getElementById("Alto_Min").onkeyup = function () {
			var Alto = document.getElementById("Alto_Min").value;

			if (isNaN(Alto)){
				document.getElementById("Alto_Min_Label").style.color = "red";
			}
			if (!isNaN(Alto)){
				document.getElementById("Alto_Min_Label").style.color = "";
			}
		}

		document.getElementById("Ancho_Max").onkeyup = function () {
			var Ancho = document.getElementById("Ancho_Max").value;

			if (isNaN(Ancho)){
				document.getElementById("Ancho_Max_Label").style.color = "red";
			}
			if (!isNaN(Ancho)){
				document.getElementById("Ancho_Max_Label").style.color = "";
			}
		}

		document.getElementById("Ancho_Min").onkeyup = function () {
			var Ancho = document.getElementById("Ancho_Min").value;

			if (isNaN(Ancho)){
				document.getElementById("Ancho_Min_Label").style.color = "red";
			}
			if (!isNaN(Ancho)){
				document.getElementById("Ancho_Min_Label").style.color = "";
			}
		}

		document.getElementById("Largo_Max").onkeyup = function () {
			var Largo = document.getElementById("Largo_Max").value;

			if (isNaN(Largo)){
				document.getElementById("Largo_Max_Label").style.color = "red";
			}
			if (!isNaN(Largo)){
				document.getElementById("Largo_Max_Label").style.color = "";
			}
		}

		document.getElementById("Largo_Min").onkeyup = function () {
			var Largo = document.getElementById("Largo_Min").value;

			if (isNaN(Largo)){
				document.getElementById("Largo_Min_Label").style.color = "red";
			}
			if (!isNaN(Largo)){
				document.getElementById("Largo_Min_Label").style.color = "";
			}
		}


		document.getElementById("form").onsubmit = function () {
			var Precio1 = document.getElementById("Precio_Max").value;
			var Precio2 = document.getElementById("Precio_Min").value;
			var Alto1 = document.getElementById("Alto_Max").value;
			var Alto2 = document.getElementById("Alto_Min").value;
			var Ancho1 = document.getElementById("Ancho_Max").value;
			var Ancho2 = document.getElementById("Ancho_Min").value;
			var Largo1 = document.getElementById("Largo_Max").value;
			var Largo2 = document.getElementById("Largo_Min").value;

			if (isNaN(Precio1) || isNaN(Precio2) || isNaN(Alto1) || isNaN(Alto2) || isNaN(Ancho1) || isNaN(Ancho2) || isNaN(Largo1) || isNaN(Largo2) ){
				alert("No se pudo realizar la búsqueda, compruebe los valores ingresados")
				return false
			}
		}





	</script>
</body>
</html>