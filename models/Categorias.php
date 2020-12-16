<?php

// models/Categorias.php

class Categorias extends Model {
	
	public function getTodos() {
		$this->db->query("SELECT * FROM categorias");
		return $this->db->fetchAll();
    }

    public function ValidacionIdCategoria ($Id_Categoria) {
		if(is_int($Id_Categoria)) 
			{
				if($Id_Categoria < 0) throw new ValidacionExceptionCategorias('Error 0');
			}
		else if(!ctype_digit($Id_Categoria)) throw new ValidacionExceptionCategorias('Error 1');
		$this->db->query("SELECT 1 FROM categorias WHERE Id_Categoria = $Id_Categoria LIMIT 1");
		if($this->db->numRows() != 1) throw new ValidacionExceptionCategorias('Error 91');
		return true;
	}


}

class ValidacionExceptionCategorias extends Exception {}