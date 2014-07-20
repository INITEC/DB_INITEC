<?php 
require_once ("../require/conexion_class.php");

class trabajo_grupos {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
	
	private function verificar_trab_grupo ($id_integrante, $id_grupo,$id_temporada){
		$sql = "SELECT * FROM trabajo_grupos WHERE id_integrante ='".$id_integrante."' AND
					id_grupo ='".$id_grupo."' AND id_temporada ='".$id_temporada."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
	}
	
	private function registrar_trab_grupo ($id_integrante, $id_grupo, $id_temporada){
		$sql = "INSERT INTO `trabajo_grupos`(`id_trab_grupo`, `id_integrante`, `id_grupo`, `id_temporada`, `n_horas`) 
					VALUES (null, '".$id_integrante."', '".$id_grupo."', '".$id_temporada."', '0')";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
	
	private function obtener_id_trab_grupo ($id_integrante, $id_grupo, $id_temporada){
		$sql = "SELECT * FROM trabajo_grupos WHERE id_integrante ='".$id_integrante."' AND
					id_grupo ='".$id_grupo."' AND id_temporada ='".$id_temporada."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		$trab_grupo = $this->_conexion->retornar_array();
		return $trab_grupo["id_trab_grupo"];
	}
	
	private function verificar_registrar_trab_grupo ($id_integrante, $id_grupo, $id_temporada){
		if($this->verificar_trab_grupo($id_integrante, $id_grupo, $id_temporada) == 0 ) {
			$this->registrar_trab_grupo($id_integrante, $id_grupo, $id_temporada);
		}
		return $this->obtener_id_trab_grupo($id_integrante, $id_grupo, $id_temporada);
	}
	
	public function cambiar_horas_trab_grupo ($id_integrante, $id_grupo, $id_temporada, $n_horas){
		$id_trab_grupo = $this->verificar_registrar_trab_grupo($id_integrante, $id_grupo, $id_temporada);
		$sql = "UPDATE trabajo_grupos SET n_horas = n_horas + ".$n_horas." WHERE id_trab_grupo = '".$id_trab_grupo."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
}

?>