<?php
require_once ("../require/conexion_class.php");

class reglamentos {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function ver_reglamento ($id_reglamento){
        $sql = "SELECT * FROM reglamentos WHERE id_reglamento='".$id_reglamento."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_nom_reglamento ($id_reglamento){
        $reglamento = $this->ver_reglamento($id_reglamento);
        return $reglamento["nom_reglamento"];
    }
        public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
   
}  
?>