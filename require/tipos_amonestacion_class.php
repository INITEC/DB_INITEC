<?php
require_once ("../require/conexion_class.php");

class tipos_amonestacion {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function ver_tipo_amonestacion ($id_tipo_amonestacion){
        $sql = "SELECT * FROM tipos_amonestacion WHERE id_tipo_amonestacion='".$id_tipo_amonestacion."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_peso ($id_tipo_amonestacion){
        $tipo_amonestacion = $this->ver_tipo_amonestacion($id_tipo_amonestacion);
        return $tipo_amonestacion["peso_amonestacion"];
    }
    
    public function ver_nom_tipo ($id_tipo_amonestacion){
        $tipo_amonestacion = $this->ver_tipo_amonestacion($id_tipo_amonestacion);
        return $tipo_amonestacion["nom_tipo"];
    }
        public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
   
}  
?>