<?php
require_once ("../require/conexion_class.php");

class usuarios {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function ver_ultima_id_temporada (){
        $sql = "SELECT `id_temporada` FROM `temporadas` ORDER BY id_temporada DESC LIMIT 1";
        $this->_conexion->ejecutar_sentencia($sql);
        $temporada = $this->retornar_SELECT();
        return $temporada["id_temporada"];
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
    
    
}
?>