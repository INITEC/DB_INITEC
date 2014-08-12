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

    public function cambio ($id_reunion, $fecha, $hora_inicio, $hora_final, $id_grupo){
        $id_dia_trabajo = $this->_dias_trabajo->obtener_id_dia ($fecha);
        $sql = "UPDATE `reuniones` SET id_dia_trabajo='".$id_dia_trabajo."', hora_inicio='".$hora_inicio."', hora_final='".$hora_final."', id_grupo='".$id_grupo."'  WHERE id_reunion='".$id_reunion."' ";
            return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_reuniones ($id_temporada){
		$sql = "SELECT * FROM `reuniones` WHERE id_temporada='".$id_temporada."' ORDER BY id_reunion DESC";
		return $this->_conexion->ejecutar_sentencia($sql);		
	}
    
    public function ver_reuniones_all (){
        $sql = "SELECT * FROM `reuniones` ";
		return $this->_conexion->ejecutar_sentencia($sql);		
    }
    
    public function guardar_dia_trabajo ($id_reunion, $id_dia_trabajo){
        $sql = "UPDATE `reuniones` SET id_dia_trabajo='".$id_dia_trabajo."' WHERE id_reunion='".$id_reunion."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_reunion ($id_reunion) {
        $sql = "SELECT * FROM `reuniones` WHERE id_reunion='".$id_reunion."' ";
		$this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_fecha_reunion ($id_reunion){
        $reunion = $this->ver_reunion($id_reunion);
        return $this->_dias_trabajo->ver_fecha($reunion["id_dia_trabajo"]);
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}
?>