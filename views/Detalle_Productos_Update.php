<?php

// views/Detalle_Productos_Update.php

class Detalle_Productos_Update extends View {
	
	public $Navegacion = array();
	
	public $Productos;
	public $Categorias;
	public $Materiales;
	public $Colores;

	public function add_Navegacion ($Name, $Path){
		$this->Navegacion[] = ['Name' => $Name, 'Path' => $Path];	
	}
	
}