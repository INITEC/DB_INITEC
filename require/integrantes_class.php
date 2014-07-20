<?php 
require_once ("../require/conexion_class.php");

class integrantes {
	private $_conexion;
	private $_integrante;
	private $_datos_integrante;
	
	public function __construct () {
		$this->_conexion = new conexion;
	}
	public function establecer_integrante ($id_integrante){
		$sql = "SELECT * FROM integrantes WHERE id_integrante = '".$id_integrante."'";
		$this->_conexion->ejecutar_sentencia($sql);
		$this->_integrante = $this->_conexion->retornar_array();
		$sql = "SELECT * FROM datos_integrantes WHERE id_integrante = '".$id_integrante."'";
		$this->_conexion->ejecutar_sentencia($sql);
		$this->_datos_integrante = $this->_conexion->retornar_array();
		
	}
	public function foto() {
		echo $this->_integrante["foto"];
	}
	public function retornar_id_trabajo (){
		return $this->_datos_integrante["id_trabajo"];
	}
	public function ver_integrantes (){
		$sql = "SELECT * FROM integrantes WHERE estado='activo' ORDER BY integrante ASC";
		$this->_conexion->ejecutar_sentencia($sql);
	}
	public function ver_nombres (){
		$sql = "SELECT id_integrante,integrante FROM integrantes WHERE estado='activo' ORDER BY integrante ASC";
		$this->_conexion->ejecutar_sentencia($sql);	
	}
	public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
	public function cambiar_trabajo ($id_integrante, $id_trabajo){
		$sql = "UPDATE `datos_integrantes` SET `id_trabajo`='".$id_trabajo."' WHERE `id_integrante`= '".$id_integrante."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
	public function verificar_activo($id_integrante){
		$sql = "SELECT id_integrante,estado FROM integrantes WHERE id_integrante ='".$id_integrante."'
					AND estado ='activo' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
	}

}
?>