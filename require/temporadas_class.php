<?php
require_once ("../require/conexion_class.php");

class temporadas {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function ver_temporada ($id_temporada){
        $sql = "SELECT * FROM `temporadas` WHERE id_temporada='".$id_temporada."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_max_amonestaciones ($id_temporada){
        $temporada = $this->ver_temporada($id_temporada);
        return $temporada ["max_amonestaciones"];
    }
    
    public function ver_max_faltas ($id_temporada){
        $temporada = $this->ver_temporada($id_temporada);
        return $temporada ["max_faltas"];
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