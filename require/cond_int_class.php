<?php
require_once ("../require/conexion_class.php");
require_once ("../require/tipo_cond_int.php");

class cond_int {
	private $_conexion;
    private $_tipo_cond_int;
	
	public function __construct (){
		$this->_conexion = new conexion();
        $this->_tipo_cond_int = new tipo_cond_int();
	}
    
    public function nuevo($id_tipo_cond, $id_persona){
        // visible -> 1=visible -> 2=no visible
        $sql = "INSERT INTO `cond_int`(`id_cond_int`, `id_tipo_cond`, `id_persona`, `fecha_cond`) VALUES (null, '".$id_tipo_cond."', '".$id_persona."', now() )";
		return $this->_conexion->ejecutar_sentencia($sql);
    }
    public function cambiar_fecha($id_cond_int, $fecha_new){
        $sql = "UPDATE `cond_int` SET `fecha_cond`='".$fecha_new."' WHERE `id_cond_int`='".$id_cond_int."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    public function cambiar_id_tipo ($id_cond_int, $id_tipo_cond){
        $sql = "UPDATE `cond_int` SET `id_tipo_cond`='".$id_tipo_cond."' WHERE `id_cond_int`='".$id_cond_int."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    public function ver_cond ($id_cond_int){
        $sql = "SELECT * FROM `cond_int` WHERE id_cond_int='".$id_cond_int."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    public function ver_cond_persona ($id_persona){
        $sql = "SELECT * FROM `cond_int` WHERE id_persona='".$id_persona."' ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    protected function ver_id_tipo($id_cond_int){
        $cond = $this->ver_cond($id_cond_int);
        return $cond["id_tipo_cond"];
    }
    public function ver_nombre_cond ($id_cond_int){
        $id_tipo_cond = $this->ver_id_tipo($id_cond_int);
        return $this->_tipo_cond_int->ver_nombre($id_tipo_cond);        
    }
    public function ver_fecha_cond ($id_cond_int){
        $cond = $this->ver_cond($id_cond_int);
        return $cond["fecha_cond"];
    }
    public function ver_nombre ($id_tipo_cond){
        return $this->_tipo_cond_int->ver_nombre($id_tipo_cond);
    }
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}   
}
?>