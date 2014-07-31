<?php 
require_once ("../require/conexion_class.php");
require_once ("../require/trabajo_grupos_class.php");
require_once ("../require/trabajo_total_class.php");
require_once ("../require/dias_trabajo_class.php");

class horas_trabajo {
	private $_conexion;
	private $_trab_grupo;
	private $_trab_total;
    private $_dias_trabajo;
	
	public function __construct (){
		$this->_conexion = new conexion();
		$this->_trab_grupo = new trabajo_grupos();
		$this->_trab_total = new trabajo_total();
        $this->_dias_trabajo = new dias_trabajo();
	}
	
	public function ver_horas_trabajo_int ($id_persona){
        $sql = "SELECT * FROM horas_trabajo WHERE id_persona='".$id_persona."' AND id_cond_hora='1' ";
		$this->_conexion->ejecutar_sentencia($sql);
	}

	public function ver_horas_en_espera ($id_grupo){
        $sql = "SELECT * FROM `horas_trabajo` WHERE id_grupo='".$id_grupo."' AND id_cond_hora='2' ";
		$this->_conexion->ejecutar_sentencia($sql);
	}

	public function ver_fecha ($id_dia_trabajo) {
		return $this->_dias_trabajo->ver_fecha();
	}
	
	public function verificar_dia (){
		return $this->_dias_trabajo->verificar_dia();
	}
	
	private function verificar_registro_horas($id_integrante,$id_grupo){
		$id_dia_trab = $this->obtener_id_dia();
		$sql = "SELECT * FROM horas_trabajo WHERE id_dia_trabajo ='".$id_dia_trab."' AND id_integrante ='".$id_integrante."'
					AND id_grupo ='".$id_grupo."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
	}
	
	private function verificar_existe_horas($id_horas_trab){
		$sql = "SELECT id_horas_trab FROM horas_trabajo WHERE id_horas_trab ='".$id_horas_trab."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
	}
	
	public function obtener_id_dia (){
		$this->crear_dia_nuevo();
		$sql = "SELECT * FROM dias_trabajo WHERE fecha_dia = curdate() ";
		$this->_conexion->ejecutar_sentencia($sql);
		$dia = $this->_conexion->retornar_array();
		return $dia["id_dia_trabajo"];
	}
	
	public function crear_dia_nuevo (){
		if($this->verificar_dia() == 0) {
			$sql = "INSERT INTO `dias_trabajo`(`id_dia_trabajo`, `fecha_dia`) VALUES (null, now())";
			return $this->_conexion->ejecutar_sentencia($sql);
		}else {
			return true;
		}
	}
	
	public function datos_horas_trabajo ($id_horas_trab){
		$sql = "SELECT * FROM horas_trabajo WHERE id_horas_trab ='".$id_horas_trab."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->retornar_array();
	}
	
	public function registrar_horas_trabajo ($id_integrante,$id_grupo,$comentario,$n_horas){
		$id_dia_trabajo = $this->obtener_id_dia();
		if($this->verificar_registro_horas($id_integrante,$id_grupo) == 0 ) {
			$sql = "INSERT INTO `horas_trabajo`(`id_horas_trab`, `id_integrante`, `id_grupo`, `id_cond_hora`, `comentario`, `id_dia_trabajo`, `n_horas`) 
			VALUES (null, '".$id_integrante."', '".$id_grupo."', '0', '".$comentario."', '".$id_dia_trabajo."', '".$n_horas."') ";
			return $this->_conexion->ejecutar_sentencia($sql);
		}
	}
	
	public function validar_horas_trabajo ($id_horas_trab,$id_temporada){
		if($this->verificar_existe_horas($id_horas_trab) != 0 ) {
			$datos_horas = $this->datos_horas_trabajo($id_horas_trab);
			$id_integrante = $datos_horas["id_integrante"];
			$id_grupo = $datos_horas["id_grupo"];
			$n_horas = $datos_horas["n_horas"];
			if($datos_horas["id_cond_hora"] == '0') {
			$this->_trab_grupo->variar_horas_trab_grupo($id_integrante, $id_grupo, $id_temporada, $n_horas);
			$this->_trab_total->variar_horas_trab_total($id_integrante, $id_temporada, $n_horas);
				$sql = "UPDATE horas_trabajo SET id_cond_hora = '1' WHERE id_horas_trab ='".$id_horas_trab."' ";
				return $this->_conexion->ejecutar_sentencia($sql);
			}else {
				return true;
			}
		}else {
			return false;
		}
	}
	
	public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}

}
?>