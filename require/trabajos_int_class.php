<?php 
require_once ("../require/conexion_class.php");

class trabajos_int {
	private $_conexion;
	
	public function __construct () {
		$this->_conexion = new conexion;
	}
	
	public function crear_trabajo ($nom_trabajo) {
		$sql = "INSERT INTO `trabajos_int`(`id_trabajo`, `nom_trabajo`, `estado_trabajo`) 
					VALUES (null, '".$nom_trabajo."', '1' )";
		return ($this->_conexion->ejecutar_sentencia($sql));		
	}
	public function desactivar_trabajo ($id_trabajo) {
		$sql = "UPDATE `trabajos_int` SET estado_trabajo = 0 WHERE id_trabajo='".$id_trabajo."' ";
		return ($this->_conexion->ejecutar_sentencia($sql));
	}
	public function ver_trabajos () {
		$sql = "SELECT * FROM `trabajos_int` WHERE estado_trabajo = '1' ";
		return ($this->_conexion->ejecutar_sentencia($sql));
	}
	public function retornar_SELECT (){
		return $this->_conexion->retornar_array();
	}
	public function cambiar_nom_trabajo ($id_trabajo, $nom_trabajo){
		$sql = "UPDATE `trabajos_int` SET `nom_trabajo`='".$nom_trabajo."' WHERE `id_trabajo`= '".$id_trabajo."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
}

?>