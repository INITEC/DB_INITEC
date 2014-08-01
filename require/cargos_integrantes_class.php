<?php
require_once ("../require/conexion_class.php");

class cargos_integrantes {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function nuevo ($nom_cargo, $abreviatura){
        if ($this->verificar_nombre($nom_cargo) == 0 ) {
            $sql = "INSERT INTO `cargos_integrantes` (`id_cargo_int`, `nom_cargo`, `abreviatura`) VALUES (null, '".$nom_cargo."', '".$abreviatura."' )";
            return $this->_conexion->ejecutar_sentencia();
        } else {
            echo "<script type='text/javascript' language='javascript' >
            alert ('El nombre del cargo ya existe');
			</script>";
            return 0;
        }
    }
    
    public function cambiar_nom_cargo ($id_cargo_int, $nom_cargo){
        $sql = "UPDATE `cargos_integrantes` SET `nom_cargo`='".$nom_cargo."' WHERE `id_cargo_int`= '".$id_cargo_int."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function cambiar_abreviatura ($id_cargo_int, $abreviatura){
        $sql = "UPDATE `cargos_integrantes` SET `abreviatura`='".$abreviatura."' WHERE `id_cargo_int`= '".$id_cargo_int."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function verificar_nombre ($nom_cargo) {
        $sql = "SELECT nom_cargo FROM `cargos_integrantes` WHERE nom_cargo='".$nom_cargo."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function ver_cargo_int ($id_cargo_int){
        $sql = "SELECT * FROM `cargos_integrantes` WHERE id_cargo_int='".$id_cargo_int."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_nom_cargo ($id_cargo_int){
        $cargo = $this->ver_cargo_int($id_cargo_int);
        return $cargo["nom_cargo"];
    }
    
    public function ver_abreviatura ($id_cargo_int){
        $cargo = $this->ver_cargo_int($id_cargo_int);
        return $cargo["abreviatura"];
    }
    
    public function ver_cargos () {
        $sql = "SELECT * FROM `cargos_integrantes` ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_num_telefono ($id_persona){
        $telefono = $this->ver_telefono($id_persona);
        if ($telefono != 0){
            return $telefono["telefono"]; 
        } else {
            return "sin telefono";
        }
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
   
}  
?>