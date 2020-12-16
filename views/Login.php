<?php

// views/Login.php

class Login extends View {

	public $Navegacion = array();
	public $Mensaje;

	public function add_Navegacion ($Name, $Path){
		$this->Navegacion[] = ['Name' => $Name, 'Path' => $Path];	
	}
	
}