<?php

// views/Alta_Admin.php

class Alta_Admin extends View {

	public $Navegacion = array();
	public $Mensaje;

	public function add_Navegacion ($Name, $Path){
		$this->Navegacion[] = ['Name' => $Name, 'Path' => $Path];	
	}
	
}