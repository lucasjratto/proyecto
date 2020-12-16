<?php

// views/Detalle_Productos.php

class Detalle_Productos extends View {
	public $Navegacion = array();
	
	public $Productos;

	public function add_Navegacion ($Name, $Path){
		$this->Navegacion[] = ['Name' => $Name, 'Path' => $Path];	
	}
	
}