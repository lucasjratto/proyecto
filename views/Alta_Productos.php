<?php

// views/Alta_Productos.php

class Alta_Productos extends View {

	public $Categorias;
	public $Materiales;
	public $Colores;

	public $Navegacion = array();

	public function add_Navegacion ($Name, $Path){
		$this->Navegacion[] = ['Name' => $Name, 'Path' => $Path];	
	}
	
}