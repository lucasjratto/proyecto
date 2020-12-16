<?php

// models/Materiales.php

class Materiales extends Model {
	
	public function getTodos() {
		$this->db->query("SELECT * FROM materiales");
		return $this->db->fetchAll();
    }

    public function ValidacionIdMateriales ($Id_Material) {
		if(is_int($Id_Material)) 
			{
				if($Id_Material < 0) throw new ValidacionExceptionMateriales('Error 0');
			}
		else if(!ctype_digit($Id_Material)) throw new ValidacionExceptionMateriales('Error 1');
		$this->db->query("SELECT 1 FROM materiales WHERE Id_Material = $Id_Material LIMIT 1");
		if($this->db->numRows() != 1) throw new ValidacionExceptionMateriales('Error 91');
		return true;
	}


}

class ValidacionExceptionMateriales extends Exception {}