<?php
require_once ("../require/conexion_class.php");
require_once ("../require/dias_trabajo_class.php");

class reuniones {
	private $_conexion;
    private $_dias_trabajo;
	
	public function __construct (){
		$this->_conexion = new conexion();
        $this->_dias_trabajo = new dias_trabajo();
	}
    
    public function nuevo($fecha, $hora_inicio, $hora_final, $lugar, $asunto, $id_temporada, $id_grupo){
            $id_dia_trabajo = $this->_dias_trabajo->obtener_id_dia ($fecha);
            $sql = "INSERT INTO `reuniones`(`id_reunion`, `id_dia_trabajo`, `hora_inicio`, `hora_final`, `lugar`, `asunto`, `id_temporada`, `id_grupo`) VALUES (null, '".$id_dia_trabajo."', '".$hora_inicio."', '".$hora_final."', '".$lugar."', '".$asunto."', '".$id_temporada."', '".$id_grupo."')";
            return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function verificar_asistencia($id_persona, $id_reunion){
        $sql = "SELECT id_persona, id_reunion FROM `asistencias` WHERE id_persona='".$id_persona."' AND id_reunion='".$id_reunion."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function cambio ($id_asistencia, $hora_asistencia, $id_cond_asist ){
            $sql = "UPDATE `asistencias` SET hora_asistencia='".$hora_asistencia."', id_cond_asist='".$id_cond_asist."', id_persona='".$id_persona."', id_reunion='".$id_reunion."'  WHERE id_asistencia='".$id_asistencia."' ";
            return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_asistencias ($id_reunion){
		$sql = "SELECT cond_asist.orden,asistencias.* FROM cond_asist,asistencias WHERE asistencias.id_reunion='".$id_reunion."' AND asistencias.id_cond_asist=cond_asist.id_cond_asist ORDER BY cond_asist.orden,asistencias.hora_asistencia ASC";
		return $this->_conexion->ejecutar_sentencia($sql);		
	}
    
    public function ven_nom_condicion ($id_cond_asist){
        return $this->_cond_asist->ver_nom_condicion($id_cond_asist);
    }
    
    public function ver_asistencia ($id_cond_asist) {
        return $this->_cond_asist->ver_asistencia($id_cond_asist);
    }
    
	public function ver_asistencias_int ($id_persona){
		$sql = "SELECT * FROM asistencias WHERE id_persona = '".$id_persona."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}
?>