<?php
require_once ("../require/conexion_class.php");
require_once ("../require/tipo_cond_int.php");

class cond_int {
	private $_conexion;
    private $_tipo_cond_int;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function nueva($id_tipo_cond, $id_persona){
        $sql = "INSERT INTO `cond_int`(`id_cond_int`, `id_tipo_cond`, `id_persona`, `fecha_cond`) VALUES (null, '".$id_tipo_cond."', '".$id_persona."', now() )";
		$this->_conexion->ejecutar_sentencia($sql);
    }
    public function cambiar_fecha($id_cond_int, $fecha_new){
        $sql = "UPDATE `cond_int` SET `fecha_cond`='".$fecha_new."' WHERE `id_cond_int`='".$id_cond_int."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    public function ver_tipos (){
		return $_tipo_cond_int->ver_tipos();		
	}
	public function ver_tipo ($id_tipo_cond){
		return $_tipo_cond_int->ver_tipo($id_tipo_cond);
	}
    public function ver_cond_actual ($id_cond_int){
        $sql = "SELECT id_cond_int,id_tipo_cond FROM `cond_int` WHERE id_cond_int='".$id_cond_int."' ";
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
    public function ingresar_nuevo($nombre, $apellido){
        $id_persona = $this->crear_persona();
        $this->ingresar_nombre($id_persona, $nombre);
        $this->ingresar_apellido($id_persona, $apellido);
    }
    
}
?>