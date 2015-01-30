<?php
require_once ("../require/conexion_class.php");

class personas {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function crear_persona(){
        $sql = "INSERT INTO `personas`(`id_persona`) VALUES (null)";
		if($this->_conexion->ejecutar_sentencia($sql)){
            return $this->ultima_persona();    
        }
    }
    public function ultima_persona(){
        $sql = "SELECT `id_persona` FROM `personas` ORDER BY id_persona DESC LIMIT 1";
        $this->_conexion->ejecutar_sentencia($sql);
        $persona = $this->retornar_SELECT();
        return $persona["id_persona"];
    }
    public function cambiar_nombre($id_persona, $nombre){
        $sql = "UPDATE `personas` SET nombres='".$nombre."' WHERE id_persona='".$id_persona."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
    }
    public function cambiar_apellido($id_persona, $apellido){
        $sql = "UPDATE `personas` SET apellidos='".$apellido."' WHERE id_persona='".$id_persona."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
    }
    public function ver_personas (){
		$sql = "SELECT * FROM personas ORDER BY apellidos ASC";
		return $this->_conexion->ejecutar_sentencia($sql);		
	}
	public function ver_persona ($id_persona){
		$sql = "SELECT * FROM personas WHERE id_persona = '".$id_persona."'";
		$this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
	}
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
    public function ingresar_nuevo($nombre, $apellido){
        $id_persona = $this->crear_persona();
        $this->cambiar_nombre($id_persona, $nombre);
        $this->cambiar_apellido($id_persona, $apellido);
    }
}
?>