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
	
    public function obtener_fecha_hoy (){
        return $this->_dias_trabajo->obtener_fecha_hoy();
    }
    
	private function verificar_registro_horas($id_persona, $id_grupo, $fecha){
		$id_dia_trab = $this->_dias_trabajo->obtener_id_dia($fecha);
		$sql = "SELECT * FROM `horas_trabajo` WHERE id_dia_trabajo='".$id_dia_trab."' AND id_persona='".$id_persona."' AND id_grupo ='".$id_grupo."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
	}
	
	private function verificar_existe_horas($id_horas_trab){
		$sql = "SELECT id_horas_trab FROM horas_trabajo WHERE id_horas_trab ='".$id_horas_trab."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
	}
	
	public function obtener_id_dia ($fecha){
		$this->_dias_trabajo->crear_fecha_nuevo($fecha);
		return $this->_obtener_id_dia($fecha);
	}
	
	public function datos_horas_trabajo ($id_horas_trab){
		$sql = "SELECT * FROM horas_trabajo WHERE id_horas_trab ='".$id_horas_trab."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->retornar_array();
	}
	
	public function registrar_horas_trabajo ($id_persona, $id_grupo, $comentario, $fecha, $n_horas){
        // id_cond_hora = 2  ---> equivale a condicion EN ESPERA
		if($this->verificar_registro_horas($id_persona, $id_grupo, $fecha) == 0 ) {
            $id_dia_trabajo = $this->_dias_trabajo->obtener_id_dia($fecha);
			$sql = "INSERT INTO `horas_trabajo`(`id_horas_trab`, `id_persona`, `id_grupo`, `id_cond_hora`, `comentario`, `id_dia_trabajo`, `n_horas`) VALUES (null, '".$id_persona."', '".$id_grupo."', '2', '".$comentario."', '".$id_dia_trabajo."', '".$n_horas."') ";
			return $this->_conexion->ejecutar_sentencia($sql);
		}else {
            return 0;
        }
            
	}
	
	public function validar_horas_trabajo ($id_horas_trab,$id_temporada){
		if($this->verificar_existe_horas($id_horas_trab) != 0 ) {
			$datos_horas = $this->datos_horas_trabajo($id_horas_trab);
			$id_persona = $datos_horas["id_persona"];
			$id_grupo = $datos_horas["id_grupo"];
			$n_horas = $datos_horas["n_horas"];
			if($datos_horas["id_cond_hora"] == '2') {
                $this->_trab_grupo->variar_horas_trab_grupo($id_persona, $id_grupo, $id_temporada, $n_horas);
                $this->_trab_total->variar_horas_trab_total($id_persona, $id_temporada, $n_horas);
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