<?php
require_once ("../require/conexion_class.php");

class cond_int {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function nueva($id_tipo_cond, $id_persona){
        $sql = "INSERT INTO `cond_int`(`id_cond_int`, `id_tipo_cond`, `id_persona`, `fecha_cond`) VALUES (null, '".$id_tipo_cond."', '".$id_persona."', now() )";
		if($this->_conexion->ejecutar_sentencia($sql)){
            return $this->ultima_persona();    
        }
    }
    public function ultima_persona(){
        $sql = "SELECT `id_persona` FROM `personas` ORDER BY id_persona DESC LIMIT 1";
        $this->_conexion->ejecutar_sentencia($sql);
        $persona = $this->_conexion->retornar_array();
        return $persona["id_persona"];
    }
    public function ingresar_nombre($id_persona, $nombre){
        $sql = "UPDATE `personas` SET nombres='".$nombre."' WHERE id_persona='".$id_persona."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
    }
    public function ingresar_apellido($id_persona, $apellido){
        $sql = "UPDATE `personas` SET apellidos='".$apellido."' WHERE id_persona='".$id_persona."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
    }
    public function ver_personas (){
		$sql = "SELECT * FROM personas ORDER BY orden ASC";
		return $this->_conexion->ejecutar_sentencia($sql);		
	}
	public function ver_persona ($id_persona){
		$sql = "SELECT * FROM personas WHERE id_persona = '".$id_persona."'";
		return $this->_conexion->ejecutar_sentencia($sql);
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