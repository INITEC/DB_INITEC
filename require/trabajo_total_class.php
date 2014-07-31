<?php 
require_once ("../require/conexion_class.php");

class trabajo_total {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
	
	private function verificar_trab_total ($id_persona, $id_temporada){
		$sql = "SELECT * FROM trabajo_total WHERE id_persona ='".$id_persona."' AND id_temporada ='".$id_temporada."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
	}
	
	private function registrar_trab_total ($id_persona, $id_temporada){
		$sql = "INSERT INTO `trabajo_total`(`id_trab_total`, `id_persona`, `id_temporada`, `n_horas`) 
					VALUES (null, '".$id_persona."', '".$id_temporada."', '0')";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
	
	private function obtener_id_trab_total ($id_persona, $id_temporada){
		$sql = "SELECT * FROM trabajo_total WHERE id_persona ='".$id_persona."' AND id_temporada ='".$id_temporada."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		$trab_grupo = $this->_conexion->retornar_array();
		return $trab_grupo["id_trab_total"];
	}
	
	private function verificar_registrar_trab_total ($id_persona, $id_temporada){
		if($this->verificar_trab_total($id_persona, $id_temporada) == 0 ) {
			$this->registrar_trab_total($id_persona, $id_temporada);
		}
		return $this->obtener_id_trab_total($id_persona, $id_temporada);
	}
	
	public function variar_horas_trab_total ($id_persona, $id_temporada, $n_horas){
		$id_trab_total = $this->verificar_registrar_trab_total($id_persona, $id_temporada);
		$sql = "UPDATE trabajo_total SET n_horas = n_horas + ".$n_horas." WHERE id_trab_total = '".$id_trab_total."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
	}

}

?>