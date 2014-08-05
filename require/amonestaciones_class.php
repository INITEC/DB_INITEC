<?php
require_once ("../require/conexion_class.php");
require_once ("../require/tipos_amonestacion_class.php");
require_once ("../require/reglamentos_class.php");

class amonestaciones {
	private $_conexion;
    private $_tipos_amonestacion;
	private $_reglamentos;
    
	public function __construct (){
		$this->_conexion = new conexion();
        $this->_tipos_amonestacion = new tipos_amonestacion();
        $this->_reglamentos = new reglamentos();
	}
    
    public function ver_id_amonestaciones_int ($id_persona, $id_temporada){
        $sql = "SELECT id_amonestacion, id_tipo_amonestacion, id_receptor FROM amonestaciones WHERE id_receptor='".$id_persona."' AND id_temporada='".$id_temporada."' ORDER BY id_amonestacion ASC ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_peso_amonestacion ($id_tipo_amonestacion){
        return $this->_tipos_amonestacion->ver_peso($id_tipo_amonestacion);    
    }
    
    public function ver_nom_tipo_amonestacion ($id_tipo_amonestacion){
        return $this->_tipos_amonestacion->ver_nom_tipo($id_tipo_amonestacion);
    }
    
    public function ver_nom_reglamento ($id_reglamento){
        return $this->_reglamentos->ver_nom_reglamento($id_reglamento);
    }
    
    public function num_amonestaciones_int ($id_persona, $id_temporada){
        $this->ver_id_amonestaciones_int ($id_persona, $id_temporada);
        return $this->_conexion->tam_respuesta();
    }
    
    public function ver_amonestacion ($id_amonestacion){
        $sql = "SELECT * FROM `amonestaciones` WHERE id_amonestacion='".$id_amonestacion."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
   
}  
?>