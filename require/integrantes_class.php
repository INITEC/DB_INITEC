<?php 
require_once ("../require/conexion_class.php");

class integrantes {
	private $_conexion;
	private $_persona;
	private $_datos_integrante;
	
	public function __construct () {
		$this->_conexion = new conexion;
	}
	public function establecer_integrante ($id_persona){
		$sql = "SELECT * FROM personas WHERE id_persona = '".$id_persona."'";
		$this->_conexion->ejecutar_sentencia($sql);
		$this->_integrante = $this->_conexion->retornar_array();
		$sql = "SELECT * FROM datos_integrantes WHERE id_persona = '".$id_persona."'";
		$this->_conexion->ejecutar_sentencia($sql);
		$this->_datos_integrante = $this->_conexion->retornar_array();
		
	}
	public function foto() {
		echo $this->_datos_integrante["foto"];
	}
	public function retornar_id_trabajo (){
		return $this->_datos_integrante["id_trabajo"];
	}
	public function ver_integrantes (){
		/* datos_integrantes.id_cond_int=1 es considerado como integrante inactivo */
		$sql = "SELECT * FROM personas, datos_integrantes WHERE datos_integrantes.id_cond_int=1 AND personas.id_persona=datos_integrantes.id_persona ORDER BY personas.apellidos ASC";
		$this->_conexion->ejecutar_sentencia($sql);	
	}
	public function ver_nombres (){ 
        /* datos_integrantes.id_cond_int=1 es considerado como integrante inactivo */
		$sql = "SELECT personas.id_persona, personas.nombres, personas.apellidos datos_integrantes.id_persona datos_integrantes.id_cond_int FROM personas, datos_integrantes WHERE datos_integrantes.id_cond_int=1 ORDER BY personas.apellidos ASC";
		$this->_conexion->ejecutar_sentencia($sql);	
	}
	public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
	public function cambiar_trabajo ($id_persona, $id_trabajo){
		$sql = "UPDATE `datos_integrantes` SET `id_trabajo`='".$id_trabajo."' WHERE `id_persona`= '".$id_persona."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
    public function ver_condicion_integrante($id_persona){
        $sql = "SELECT id_persona,id_condicion_int FROM integrantes WHERE id_integrante ='".$id_integrante."'
					AND estado ='activo' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
    }
	public function verificar_activo($id_persona){
		
	}

}
?>