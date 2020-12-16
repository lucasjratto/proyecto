<?php

// models/Productos.php
require '../models/Categorias.php';
require '../models/Materiales.php';
require '../models/Colores.php';

class Productos extends Model {
	
	public function getTodos() {
		$this->db->query("SELECT * FROM productos WHERE Status = 1 AND Stock > 0 ");
		return $this->db->fetchAll();
	}

	public function getIdProducto($Id_Producto) {
		$Productos = new Productos();
		if (!$Productos->ValidacionIdProducto($Id_Producto)) throw new ValidacionException('Error 2');
		$this->db->query("
							SELECT 
								p.*, 
								C.Descripcion as Descripcion_Categoria, 
								m.Descripcion as Descripcion_Material,
								co.Descripcion as Descripcion_Color

							FROM productos p
							INNER JOIN categorias c
								on c.Id_Categoria = p.Id_Categoria

							INNER JOIN materiales m
								on m.Id_Material = p.Id_Material

							INNER JOIN colores co
								on co.Id_Color = p.Id_color

							WHERE Id_Producto = $Id_Producto 
							AND status = 1

							LIMIT 1
						");
		return $this->db->fetchAll()[0];
	}

	public function getTodosCategorias() {
		$this->db->query("
							SELECT distinct c.Id_Categoria, c.Descripcion
							FROM productos P
							INNER JOIN categorias c
								on c.Id_Categoria = p.Id_Categoria
							WHERE Status = 1 AND Stock > 0 
							ORDER BY c.Id_Categoria asc
							");
		$array = array(-1 => array("Id_Categoria" => "-1", "Descripcion" => "Todos")) + $this->db->fetchAll();
		return $array;
	}

	public function getTodosMateriales() {
		$this->db->query("
							SELECT distinct c.Id_Material, c.Descripcion
							FROM productos P
							INNER JOIN materiales c
								on c.Id_Material = p.Id_Material
							WHERE Status = 1 AND Stock > 0 
							ORDER BY c.Id_Material asc
							");
		$array = array(-1 => array("Id_Material" => "-1", "Descripcion" => "Todos")) + $this->db->fetchAll();
		return $array;
	}

	public function getTodosColores() {
		$this->db->query("
							SELECT distinct c.Id_Color, c.Descripcion
							FROM productos P
							INNER JOIN Colores c
								on c.Id_Color = p.Id_Color
							WHERE Status = 1 AND Stock > 0 
							ORDER BY c.Id_Color asc
							");
		$array = array(-1 => array("Id_Color" => "-1", "Descripcion" => "Todos")) + $this->db->fetchAll();
		return $array;
	}

	public function ValidacionIdProducto ($Id_Producto) {
		if(is_int($Id_Producto)) 
			{
				if($Id_Producto < 0) throw new ValidacionException('Error 0');
			}
		else if(!ctype_digit($Id_Producto)) throw new ValidacionException('Error 1');
		$this->db->query("SELECT 1 FROM productos WHERE Id_Producto = $Id_Producto AND status = 1 LIMIT 1");
		if($this->db->numRows() != 1) throw new ValidacionException('Error 91');
		return true;
	}

	public function ValidacionNombreProducto ($Nombre) {
		if(strlen($Nombre) < 3 || strlen($Nombre) > 60) throw new ValidacionException('Error 3');
		return true;
	}

	public function ValidacionNombreProductoBusqueda ($Nombre) {
		if(strlen($Nombre) < 0 || strlen($Nombre) > 150) throw new ValidacionException('Error 33');
		return true;
	}

	public function ValidacionDescripcionProducto ($Descripcion) {
		if(strlen($Descripcion) < 10 || strlen($Descripcion) > 250) throw new ValidacionException('Error 4');
		return true;
	}

	public function ValidacionDescripcionProductoBusqueda ($Descripcion) {
		if(strlen($Descripcion) < 0 || strlen($Descripcion) > 250) throw new ValidacionException('Error 44');
		return true;
	}
	
	public function ValidacionPrecioProducto ($Precio) {
		if(!is_int($Precio)) if(!is_float($Precio)) if(!is_numeric($Precio)) throw new ValidacionException('Error 5');
		if($Precio < 0 || $Precio > 99999999 ) throw new ValidacionException('Error 6');
		return true;
	}

	public function ValidacionDimensionProducto ($Dimension) {
		if(!is_int($Dimension)) if(!is_float($Dimension)) if(!is_numeric($Dimension)) throw new ValidacionException('Error 7');
		if($Dimension < 0 || $Dimension > 99999999 ) throw new ValidacionException('Error 8');
		return true;
	}

	public function ValidacionStockProducto ($Stock) {
		if(!is_int($Stock)) if(!ctype_digit($Stock)) throw new ValidacionException('Error 9');
		if($Stock < 0 || $Stock > 99999999 ) throw new ValidacionException('Error 10');
		return true;
	}

	public function ValidacionImageProducto ($Image) {
		if ($Image["size"] > 10000000 || $Image["size"] < 1) throw new ValidacionException('Error 13');
		if ($Image["type"] != 'image/jpeg' && $Image["type"] != 'image/jpg' && $Image["type"] != 'image/png') throw new ValidacionException('Error 14');
		if(strlen($Image["name"]) < 1 || strlen($Image["name"]) > 1000) throw new ValidacionException('Error 11');
		return true;
	}

	public function getTypeImage ($Image) {
		$Productos = new Productos();
		$Productos->ValidacionImageProducto($Image);
		return str_replace('image/','.',$Image["type"]);
	}

	public function ValidacionPathImage ($Path) {
		if(strlen($Path) < 5 || strlen($Path) > 1000) throw new ValidacionException('Error 15');
		return true;
	}

	public function ValidacionExistsPathImage ($Path) {
		$Productos = new Productos();
		$Productos->ValidacionPathImage($Path);
		if(!file_exists(str_replace(PathConfig::UPLOADS_PATH, PathConfig::UPLOADS_PATH_FILE, $Path))) throw new ValidacionException('Error 16');
		return true;
	}

	public function UpdatePathImage ($Id_Producto, $Path) {
		$Productos = new Productos();
		$Productos->ValidacionIdProducto($Id_Producto);
		$Productos->ValidacionExistsPathImage($Path);

		$this->db->query("
							UPDATE productos
							SET Image = '". $this->db->escape($Path) ."'
							WHERE
								Id_Producto = $Id_Producto
							AND Status = 1
						");
		return true;
	}

	public function moveImage ($Image, $Path) {
		$Productos = new Productos();
		$Productos->ValidacionImageProducto($Image);
		$Productos->ValidacionPathImage($Path);
		
		move_uploaded_file($Image['tmp_name'], str_replace(PathConfig::UPLOADS_PATH, PathConfig::UPLOADS_PATH_FILE, $Path));
	}

	public function moveOldImage ($Id_Producto) {
		$Productos = new Productos();
		$Productos->ValidacionIdProducto($Id_Producto);

		$this->db->query("SELECT Image FROM Productos WHERE Id_Producto = $Id_Producto AND Status = 1 LIMIT 1");
		$Path_Image_Actual = str_replace(PathConfig::UPLOADS_PATH , PathConfig::UPLOADS_PATH_FILE, $this->db->fetchAll()[0]["Image"]);
		$Path_Image_Nueva = str_replace(PathConfig::UPLOADS_PATH . '/', PathConfig::UPLOADS_PATH . '/old-' . date('Y-m-d-H-i-s') . ' Id',$Path_Image_Actual);
		rename($Path_Image_Actual , $Path_Image_Nueva);
		return true;
	}

	public function AltaProducto ($Nombre, $Descripcion, $Precio, $Alto, $Ancho, $Largo, $Stock, $Image, $Id_Categoria, $Id_Material, $Id_Color) {
		$Productos = new Productos();

		$Categorias = new Categorias();
		$Materiales = new Materiales();
		$Colores = new Colores();

		$Productos->ValidacionNombreProducto($Nombre);
		$Productos->ValidacionDescripcionProducto($Descripcion);
		$Productos->ValidacionPrecioProducto($Precio);
		$Productos->ValidacionDimensionProducto($Alto);
		$Productos->ValidacionDimensionProducto($Ancho);
		$Productos->ValidacionDimensionProducto($Largo);
		$Productos->ValidacionStockProducto($Stock);
		$Productos->ValidacionImageProducto($Image);
		$Categorias->ValidacionIdCategoria($Id_Categoria);
		$Materiales->ValidacionIdMateriales($Id_Material);
		$Colores->ValidacionIdColores($Id_Color);

		$this->db->query("
							INSERT INTO productos (Nombre, Descripcion, Precio, Alto, Ancho, Largo, Stock, Image, Status, Id_Categoria, Id_Material, Id_Color)
							VALUES ('". $this->db->escape($Nombre) ."', '". $this->db->escape($Descripcion) ."', $Precio, $Alto, $Ancho, $Largo, $Stock, '', 1, $Id_Categoria, $Id_Material, $Id_Color)
						");
		$Path_Destino = PathConfig::UPLOADS_PATH . '/' . $this->db->insert_Id() . $Productos->getTypeImage($Image);

		$Productos->moveImage($Image, $Path_Destino);
		$Productos->UpdatePathImage( $this->db->insert_Id() , $Path_Destino);
		return true;
	}

	public function UpdateProducto ($Id_Producto, $Nombre, $Descripcion, $Precio, $Alto, $Ancho, $Largo, $Stock, $Image, $Id_Categoria, $Id_Material, $Id_Color) {
		$Productos = new Productos();

		$Categorias = new Categorias();
		$Materiales = new Materiales();
		$Colores = new Colores();

		$Productos->ValidacionIdProducto($Id_Producto);
		$Productos->ValidacionNombreProducto($Nombre);
		$Productos->ValidacionDescripcionProducto($Descripcion);
		$Productos->ValidacionPrecioProducto($Precio);
		$Productos->ValidacionDimensionProducto($Alto);
		$Productos->ValidacionDimensionProducto($Ancho);
		$Productos->ValidacionDimensionProducto($Largo);
		$Productos->ValidacionStockProducto($Stock);
		if(isset($Image['tmp_name']) && !empty($Image['tmp_name'])) $Productos->ValidacionImageProducto($Image);
		$Categorias->ValidacionIdCategoria($Id_Categoria);
		$Materiales->ValidacionIdMateriales($Id_Material);
		$Colores->ValidacionIdColores($Id_Color);

		$this->db->query("
							UPDATE productos 
							SET
								Nombre = '". $this->db->escape($Nombre) ."',
								Descripcion = '". $this->db->escape($Descripcion) ."',
								Precio = $Precio,
								Alto = $Alto,
								Ancho = $Ancho,
								Largo = $Largo,
								Stock = $Stock,
								Id_Categoria = $Id_Categoria,
								Id_Material = $Id_Material,
								Id_Color = $Id_Color

							WHERE
								Id_Producto = $Id_Producto
							AND Status = 1
						");

		if(isset($Image['tmp_name']) && !empty($Image['tmp_name']))
			{
				$Path_Destino = PathConfig::UPLOADS_PATH . '/' . $Id_Producto . $Productos->getTypeImage($Image);
				$Productos->moveOldImage($Id_Producto);
				$Productos->moveImage($Image, $Path_Destino);
				$Productos->UpdatePathImage( $Id_Producto , $Path_Destino);
			}
		
		return true;
	}

	public function BusquedaProducto ($Nombre, $Descripcion, $Precio_Max, $Precio_Min, $Alto_Max, $Alto_Min, $Ancho_Max, $Ancho_Min, $Largo_Max, $Largo_Min, $Id_Categoria, $Id_Material, $Id_Color ) {
		$Productos = new Productos();
		$Categorias = new Categorias();
		$Materiales = new Materiales();
		$Colores = new Colores();

		if(!empty($Nombre)) $Productos->ValidacionNombreProductoBusqueda($Nombre);
		if(!empty($Descripcion)) $Productos->ValidacionDescripcionProductoBusqueda($Descripcion);
		if(!empty($Precio_Min)) $Productos->ValidacionPrecioProducto($Precio_Min);
		if(!empty($Precio_Max)) $Productos->ValidacionPrecioProducto($Precio_Max);
		if(!empty($Alto_Min)) $Productos->ValidacionDimensionProducto($Alto_Min);
		if(!empty($Alto_Max)) $Productos->ValidacionDimensionProducto($Alto_Max);
		if(!empty($Ancho_Min)) $Productos->ValidacionDimensionProducto($Ancho_Min);
		if(!empty($Ancho_Max)) $Productos->ValidacionDimensionProducto($Ancho_Max);
		if(!empty($Largo_Min)) $Productos->ValidacionDimensionProducto($Largo_Min);
		if(!empty($Largo_Max)) $Productos->ValidacionDimensionProducto($Largo_Max);
		if(is_numeric($Id_Categoria)) if($Id_Categoria != -1) $Categorias->ValidacionIdCategoria($Id_Categoria);
		if(is_numeric($Id_Material)) if($Id_Material != -1) $Materiales->ValidacionIdMateriales($Id_Material);
		if(is_numeric($Id_Color)) if($Id_Color != -1) $Colores->ValidacionIdColores($Id_Color);
		

		$Nombre_Where = "";
		$Descripcion_Where = "";
		$Precio_Min_Where = "";
		$Precio_Max_Where = "";
		$Alto_Min_Where = "";
		$Alto_Max_Where = "";
		$Ancho_Max_Where = "";
		$Ancho_Min_Where = "";
		$Largo_Min_Where = "";
		$Largo_Max_Where = "";
		$Id_Categoria_Where = "";
		$Id_Material_Where = "";
		$Id_Color_Where = "";

		if(!empty($Nombre)) $Nombre_Where = "AND Nombre LIKE '%". $this->db->escapeWildcards($this->db->escape($Nombre)) ."%'";
		if(!empty($Descripcion)) $Descripcion_Where = "AND Nombre LIKE '%". $this->db->escapeWildcards($this->db->escape($Descripcion)) ."%'";
		if(!empty($Precio_Min)) $Precio_Min_Where = "AND Precio >= $Precio_Min";
		if(!empty($Precio_Max)) $Precio_Max_Where = "AND Precio <= $Precio_Max";
		if(!empty($Alto_Min)) $Alto_Min_Where = "AND Alto >= $Alto_Min";
		if(!empty($Alto_Max)) $Alto_Max_Where = "AND Alto <= $Alto_Max";
		if(!empty($Ancho_Min)) $Ancho_Min_Where = "AND Ancho >= $Ancho_Min";
		if(!empty($Ancho_Max)) $Ancho_Max_Where = "AND Ancho <= $Ancho_Max";
		if(!empty($Largo_Min)) $Largo_Min_Where = "AND Largo >= $Largo_Min";
		if(!empty($Largo_Max)) $Largo_Max_Where = "AND Largo <= $Largo_Max";
		if(is_numeric($Id_Categoria)) if($Id_Categoria != -1) $Id_Categoria_Where = "AND Id_Categoria = $Id_Categoria";
		if(is_numeric($Id_Material)) if($Id_Material != -1) $Id_Material_Where = "AND Id_Material = $Id_Material";
		if(is_numeric($Id_Color)) if($Id_Color != -1) $Id_Color_Where = "AND Id_Color = $Id_Color";

		$this->db->query("
							SELECT * 
							FROM productos 
							WHERE 
									Status = 1 
								AND Stock > 0 
								$Nombre_Where
								$Descripcion_Where
								$Precio_Min_Where
								$Precio_Max_Where
								$Alto_Min_Where
								$Alto_Max_Where
								$Ancho_Max_Where
								$Ancho_Min_Where
								$Largo_Min_Where
								$Largo_Max_Where
								$Id_Categoria_Where
								$Id_Material_Where
								$Id_Color_Where
						");
		return $this->db->fetchAll();
	}

	public function DeleteProducto ($Id_Producto) {
		$Productos = new Productos();
		$Productos->ValidacionIdProducto($Id_Producto);
		$Productos->moveOldImage($Id_Producto);

		$this->db->query("
							UPDATE productos
							SET
								Status = 0
							WHERE
								Id_Producto = $Id_Producto
							AND Status = 1
						");
		return true;
	}

}

class ValidacionException extends Exception {}