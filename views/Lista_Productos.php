<?php

// views/Lista_Productos.php

class Lista_Productos extends View  {

	protected $Detalle_Producto_Path = PathConfig::DETALLE_PRODUCTO_PATH;

	public $Old_Nombre;
	public $Old_Descripcion;
	public $Old_Precio_Max;
	public $Old_Precio_Min;
	public $Old_Alto_Max;
	public $Old_Alto_Min;
	public $Old_Ancho_Max;
	public $Old_Ancho_Min;
	public $Old_Largo_Max;
	public $Old_Largo_Min;
	public $Old_Categoria;
	public $Old_Material;
	public $Old_Color;

	public $Navegacion = array();
	public $Productos;
	public $Categorias;
	public $Materiales;
	public $Colores;

	public function add_Navegacion ($Name, $Path){
		$this->Navegacion[] = ['Name' => $Name, 'Path' => $Path];	
	}
	
}