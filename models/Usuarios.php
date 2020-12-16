<?php

// models/Productos.php

class Usuarios extends Model {
	
	private $Id_Usuario;

	public function altaAdmin($Email, $Pass) {
		$Usuario = new Usuarios();

		$Usuario->ValidacionEmailUsuario($Email);
		$Usuario->ValidacionPassUsuario($Pass);
		$HashPass = $Usuario->getHashPass($Pass);
		$Usuario->ValidacionHashPassUsuario($HashPass);

		$this->db->query("
							INSERT INTO usuarios (Email, Pass, Role)
							VALUES('". $this->db->escape($Email) ."', '". $this->db->escape($HashPass) ."', 'ADMIN')
						");
		return true;
	}

	public function ValidacionEmailUsuario ($Email) {
		if(strlen($Email) < 5 || strlen($Email) > 255) throw new ValidacionExceptionUsuarios('Error 20');
		if(!filter_var($Email, FILTER_VALIDATE_EMAIL)) throw new ValidacionExceptionUsuarios('Error 21');
		return true;
	}

	public function ValidacionPassUsuario ($Pass) {
		if(strlen($Pass) < 6 || strlen($Pass) > 100) throw new ValidacionExceptionUsuarios('Error 22');
		return true;
	}

	public function getHashPass ($Pass) {
		$Usuario = new Usuarios();
		$Usuario->ValidacionPassUsuario($Pass);

		return sha1($Pass);
	}
	
	public function ValidacionHashPassUsuario ($HashPass) {
		if(strlen($HashPass) != 40) throw new ValidacionExceptionUsuarios('Error 23');
		return true;
	}

	public function LoginUsuario($Email, $Pass) {
		$Usuario = new Usuarios();

		$Usuario->ValidacionEmailUsuario($Email);
		$Usuario->ValidacionPassUsuario($Pass);
		$HashPass = $Usuario->getHashPass($Pass);
		$Usuario->ValidacionHashPassUsuario($HashPass);

		$this->db->query("SELECT Id_Usuario FROM usuarios WHERE Email = '". $this->db->escape($Email) ."' and Pass = '". $this->db->escape($HashPass) ."' LIMIT 1");
		if($this->db->numRows() != 1) return false;
		$this->Id_Usuario = $this->db->fetchAll()[0]["Id_Usuario"];
		if (session_status() == PHP_SESSION_NONE) session_start();
		session_start();
		$_SESSION["Id_Usuario"] = $this->Id_Usuario;
		return true;
	}

	public function getIdUsuario () {
		return $this->Id_Usuario;
	}

	public function setIdUsuario ($Id_Usuario) {
		$this->Id_Usuario = $Id_Usuario;
		return true;
	}

	public function isLoged () {
		if (session_status() == PHP_SESSION_NONE) session_start();
		if(!isset($_SESSION["Id_Usuario"])) return false;
		return true;
	}

	public function isRoot () {
		$Usuario = new Usuarios();
		if(!$Usuario->isLoged()) return false;
		$Usuario->setIdUsuario($_SESSION["Id_Usuario"]);
		$this->db->query("SELECT Role FROM usuarios WHERE Id_Usuario = " . $Usuario->getIdUsuario() . " LIMIT 1");
		if($this->db->numRows() != 1) return false;
		if($this->db->fetchAll()[0]["Role"] != "ROOT") return false;
		return true;
	}

}

class ValidacionExceptionUsuarios extends Exception {}