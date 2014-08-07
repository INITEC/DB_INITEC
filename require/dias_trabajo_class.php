<?php 
require_once ("../require/conexion_class.php");

class dias_trabajo {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function ver_dia ($id_dia_trabajo){
        $sql = "SELECT * FROM dias_trabajo WHERE id_dia_trabajo='".$id_dia_trabajo."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_fecha ($id_dia_trabajo) {
		$dia_trab = $this->ver_dia($id_dia_trabajo);
		return $dia_trab["fecha_dia"];
	}
    
    public function obtener_fecha_hoy (){
        date_default_timezone_set('America/Los_Angeles');
        $dia=date(d);
		$mes=date(n);
		$ano=date(Y);
        $fecha = $ano."-".$mes."-".$dia;
        return $fecha;
    }
    
    public function verificar_dia (){
		$sql = "SELECT * FROM dias_trabajo WHERE fecha_dia = curdate() ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
	}
    
    public function verificar_fecha ($fecha_dia) {
        $sql = "SELECT * FROM `dias_trabajo` WHERE fecha_dia='".$fecha_dia."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function crear_dia_nuevo (){
		if($this->verificar_dia() == 0) {
			$sql = "INSERT INTO `dias_trabajo`(`id_dia_trabajo`, `fecha_dia`) VALUES (null, now())";
			return $this->_conexion->ejecutar_sentencia($sql);
		}else {
			return true;
		}
	}
    
    public function crear_fecha_nuevo ($fecha_dia){
        if($this->verificar_fecha ($fecha_dia) == 0) {
			$sql = "INSERT INTO `dias_trabajo`(`id_dia_trabajo`, `fecha_dia`) VALUES (null, '".$fecha_dia."' )";
			return $this->_conexion->ejecutar_sentencia($sql);
		}else {
			return true;
		}
    }
    
    public function obtener_id_dia ($fecha_dia){
        if($this->verificar_fecha($fecha_dia) == 0){
            $this->crear_fecha_nuevo($fecha_dia);
        }
        $sql = "SELECT * FROM `dias_trabajo` WHERE fecha_dia='".$fecha_dia."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        $dia = $this->retornar_SELECT();
        return $dia["id_dia_trabajo"];
	}
    
    public function obtener_id_dia_hoy (){
        if ($this->verificar_dia() == 0){
            $this->crear_dia_nuevo();
        }
        $sql = "SELECT * FROM dias_trabajo WHERE fecha_dia = curdate() ";
		$this->_conexion->ejecutar_sentencia($sql);
		$dia = $this->_conexion->retornar_array();
		return $dia["id_dia_trabajo"];
    }
    
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}

}