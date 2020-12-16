<?php

// models/Colores.php

class Colores extends Model {
	
	public function getTodos() {
		$this->db->query("SELECT * FROM Colores");
		return $this->db->fetchAll();
    }

    public function ValidacionIdColores ($Id_Color) {
		if(is_int($Id_Color)) 
			{
				if($Id_Color < 0) throw new ValidacionExceptionColores('Error 0');
			}
		else if(!ctype_digit($Id_Color)) throw new ValidacionExceptionColores('Error 1');
		$this->db->query("SELECT 1 FROM Colores WHERE Id_Color = $Id_Color LIMIT 1");
		if($this->db->numRows() != 1) throw new ValidacionExceptionColores('Error 91');
		return true;
	}


}

class ValidacionExceptionColores extends Exception {}