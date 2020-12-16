<!-- html/Login.php -->

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

	<style>
		body {
			background-color: #AED6F1;
			margin-left: 0px;
			margin-right: 0px;
		}

		.LOGIN {
			border-radius: 30px;
			background-color: #EBF5FB;
			margin-left: 110px;
			margin-right: 110px;
			margin-top: 50px;
			padding-top: 5px;
			padding-bottom: 5px;
		}
		
		.ITEM_FORM_BLOCK {
			margin-top: 5px;
			margin-bottom: 5px;
			zoom: 160%;
		}

		.ITEM_FORM p {
			margin-top: 5px;
			margin-bottom: 5px;
			zoom: 60%;
		}

		.ITEM_FORM {
			display: block;
    		text-align: center;
			margin-top: 2px;
		}

		div label {
			margin-top: 2px;
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

	<div class= "LOGIN">
		<form action="" method='post' class= "FORM_LOGIN" id="form">
			<div class="ITEM_FORM_BLOCK">
				<div class="ITEM_FORM">
					<label for="Email">Email:</label>
				</div>
				<div class="ITEM_FORM">
					<input type="text" id="Email" name="Email">
					<p id="email_p"></p>
				</div>
			</div>
			<div class="ITEM_FORM_BLOCK">
				<div class="ITEM_FORM">
					<label for="Pass">Password:</label>
				</div>
				<div class="ITEM_FORM">
					<input type="password" id="Pass" name="Pass">
					<p id="pass_p"></p>
				</div>
			</div>
			<div class="ITEM_FORM_BLOCK">
				<div class="ITEM_FORM">
					<input type="submit" value="Login" id='Login_Submit'>
					<p><?= $this->Mensaje ?></p>
				</div>
			</div>

		</form>
	</div>

	<script>
		"use strict"

		document.getElementById("form").onsubmit = function () {
			var error = 0;
			var PASS = document.getElementById("Pass").value;
			var EMAIL = document.getElementById("Email").value;

			if (EMAIL.length < 5 || EMAIL.length > 255 ){
				document.getElementById("email_p").innerHTML = "Error al ingresar el Email";
				var error = 1;
			}
			 
			if (PASS.length < 6 || PASS.length > 100 ) {
				document.getElementById("pass_p").innerHTML = "Error al ingresar el password";
				var error = 1;
			} 

			if(error == 1) return false;
		};

		document.getElementById("Pass").onclick = function (){
			document.getElementById("pass_p").innerHTML = "";
		}

		document.getElementById("Email").onclick = function (){
			document.getElementById("email_p").innerHTML = "";
		}

		


	
	</script>	
</body>
</html>