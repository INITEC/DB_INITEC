<?php
require_once ("../require/conexion_class.php");
require_once ("../require/cond_asist_class.php");

class asistencias {
	private $_conexion;
    private $_cond_asist;
	
	public function __construct (){
		$this->_conexion = new conexion();
        $this->_cond_asist = new cond_asist();
	}
    
    public function nuevo($hora_asistencia, $id_cond_asist, $id_persona, $id_reunion, $inasistencia){
        if($inasistencia==1){
            $inasistencia = 2;
        } else {
            $inasistencia = 1;
        }
        
        if ($this->verificar_asistencia($id_persona, $id_reunion) == 0 ){
            $sql = "INSERT INTO `asistencias`(`id_asistencia`, `hora_asistencia`, `id_cond_asist`, `id_persona`, `id_reunion`, `inasistencia`) VALUES (null, '".$hora_asistencia."', '".$id_cond_asist."', '".$id_persona."', '".$id_reunion."', '".$inasistencia."' )";
            return $this->_conexion->ejecutar_sentencia($sql);
        } else {
            return 0;
        }
    }
    
    public function ver_asistencia_int ($id_persona, $id_reunion){
        $sql = "SELECT * FROM `asistencias` WHERE id_persona='".$id_persona."' AND id_reunion='".$id_reunion."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function verificar_asistencia($id_persona, $id_reunion){
        $sql = "SELECT id_persona, id_reunion FROM `asistencias` WHERE id_persona='".$id_persona."' AND id_reunion='".$id_reunion."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function cambio ($id_asistencia, $hora_asistencia, $id_cond_asist, $inasistencia ){
        if($inasistencia==1){
            $inasistencia = 2;
        } else {
            $inasistencia = 1;
        }
        $sql = "UPDATE `asistencias` SET hora_asistencia='".$hora_asistencia."', id_cond_asist='".$id_cond_asist."', inasistencia='".$inasistencia."'  WHERE id_asistencia='".$id_asistencia."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_asistencias ($id_reunion){
		$sql = "SELECT cond_asist.orden,asistencias.* FROM cond_asist,asistencias WHERE asistencias.id_reunion='".$id_reunion."' AND asistencias.id_cond_asist=cond_asist.id_cond_asist ORDER BY cond_asist.orden,asistencias.hora_asistencia ASC";
		return $this->_conexion->ejecutar_sentencia($sql);		
	}
    
    public function num_asistentes ($id_reunion){
        $this->ver_asistencias($id_reunion);
        return $this->_conexion->tam_respuesta();
    }
    
    public function ver_asistencia ($id_asistencia){
        $sql = "SELECT * FROM asistencias WHERE id_asistencia='".$id_asistencia."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_nom_condicion ($id_cond_asist){
        return $this->_cond_asist->ver_nom_condicion($id_cond_asist);
    }
    
    public function ver_estado_asistencia ($id_cond_asist) {
        return $this->_cond_asist->ver_asistencia($id_cond_asist);
    }
    
    public function ver_condicion_asistencia ($id_cond_asist){
        $condicion = $this->_cond_asist->ver_condicion($id_cond_asist);
        return $condicion["asistencia"];
    }
    
    public function ver_class_condicion ($id_cond_asist){
        return $this->_cond_asist->ver_class_css($id_cond_asist);
    }
    
	public function ver_asistencias_int ($id_persona, $id_temporada){
		$sql = "SELECT * FROM asistencias,reuniones WHERE id_persona = '".$id_persona."' AND asistencias.id_reunion=reuniones.id_reunion AND reuniones.id_temporada='".$id_temporada."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
    
    public function ver_inasistencias_int ($id_persona, $id_temporada){
        //asistencias.inasistencia ->1=inasistencia considerada -> 2=asistencia considerada -> 3=inasistencia no considerada ->4= asistencia no considerada
        $sql = "SELECT asistencias.*,reuniones.id_reunion,reuniones.id_temporada FROM asistencias,reuniones WHERE asistencias.id_persona='".$id_persona."' AND reuniones.id_temporada='".$id_temporada."' AND asistencias.id_reunion=reuniones.id_reunion AND asistencias.inasistencia=1 ORDER BY asistencias.id_asistencia ASC ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function num_inasistencias_int ($id_persona, $id_temporada){
        $this->ver_inasistencias_int($id_persona, $id_temporada);
        return $this->_conexion->tam_respuesta();
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}
?>