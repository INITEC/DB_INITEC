<?php
require_once ("../require/conexion_class.php");

class deudas {
	private $_conexion;
    
	public function __construct (){
		$this->_conexion = new conexion();
    }
    
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
   
}  
?>