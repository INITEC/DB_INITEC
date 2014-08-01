<?php
require_once ("../require/conexion_class.php");

class operadores_telefono {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function nuevo ($nom_operador){
        if ($this->verificar_nombre($nom_operador) == 0) {
            $sql = "INSERT INTO `operadores_telefono` (`id_operador`, `nom_operador`) VALUES (null, '".$nom_operador."')";
            return $this->_conexion->ejecutar_sentencia();
        } else {
            echo "<script type='text/javascript' language='javascript' >
            alert ('El nombre del operador ya existe');
			</script>";
            return 0;
        }
    }
    
    public function verificar_nombre ($nom_operador){
        $sql = "SELECT nom_operador FROM `operadores_telefono` WHERE nom_operador='".$nom_operador."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function cambiar_nombre ($id_operador, $nom_operador) {
        $sql = "UPDATE `operadores_telefono` SET nom_operador='".$nom_operador."' WHERE id_operador='".$id_operador."' ";
        $this->_conexion->ejecutar_sentencia($sql);
    }    
    
    public function ver_operador ($id_operador){
        $sql = "SELECT * FROM `operadores_telefono` WHERE id_operador='".$id_operador."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_operadores (){
        $sql = "SELECT * FROM `operadores_telefono` ORDER BY nom_operador ASC";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_nom_operador ($id_operador){
        $operador = $this->ver_operador($id_operador);
        return $operador["nom_operador"];
    }
    
    public function verificar_operador ($id_operador){
        $sql = "SELECT id_operador FROM `operadores_telefono` WHERE id_operador='".$id_operador."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
    
}
?>