<?php 
require_once ("../require/conexion_class.php");

class lista_grupos {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion;
	}
    public function agregar_integrante ($id_persona,$id_grupo){
		$sql = "INSERT INTO `lista_grupos`(`id_lista`, `id_persona`, `id_grupo`) 
					VALUES (null, '".$id_persona."', '".$id_grupo."')";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
    public function verificar_integrante ($id_persona, $id_grupo){
		$sql = "SELECT * FROM lista_grupos WHERE id_integrante ='".$id_persona."' AND id_grupo ='".$id_grupo."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
	}
    
    public function retirar_integrante ($id_persona, $id_grupo){
        $sql = "DELETE FROM `lista_grupos` WHERE id_integrante ='".$id_integrante."' AND id_grupo ='".$id_grupo."'";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_integrantes ($id_grupo){
		$sql = "SELECT personas.*,lista_grupos.* FROM personas,lista_grupos WHERE personas.id_persona=lista_grupos.id_persona AND lista_grupos.id_grupo ='".$id_grupo."' ";
		return $this->ejecutar_sentencia($sql);
	}
	
    public function retornar_SELECT (){
		return $this->_conexion->retornar_array();
	}
    
}   