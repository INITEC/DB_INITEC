<?php
require_once ("../require/conexion_class.php");

class cond_pagos {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function ver_cond_pago ($id_cond_pago){
        $sql="SELECT * FROM cond_pagos WHERE id_cond_pago='".$id_cond_pago."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_class_css ($id_cond_pago){
        $cond_pago = $this->ver_cond_pago($id_cond_pago);
        return $cond_pago["class_css"];
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}   
}
?>