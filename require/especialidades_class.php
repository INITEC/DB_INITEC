<?php
require_once ("../require/conexion_class.php");

class especialidades {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function nuevo ($nom_especialidad){
        if ($this->verificar_nombre($nom_especialidad) == 0 ) {
            $sql = "INSERT INTO `especialidades` (`id_especialidad`, `nom_especialidad`) VALUES (null, '".$nom_especialidad."')";
            return $this->_conexion->ejecutar_sentencia();
        } else {
            echo "<script type='text/javascript' language='javascript' >
            alert ('El nombre de la especialidad ya existe');
			</script>";
            return 0;
        }
    }
    
    public function cambiar_nom_especialidad ($id_especialidad, $nom_especialidad){
        $sql = "UPDATE `especialidades` SET `nom_especialidad`='".$nom_especialidad."' WHERE `id_especialidad`= '".$id_especialidad."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function verificar_nombre ($nom_especialidad) {
        $sql = "SELECT nom_especialidad FROM `especialidades` WHERE nom_especialidad='".$nom_especialidad."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function ver_especialidad ($id_especialidad){
        $sql = "SELECT * FROM `especialidades` WHERE id_especialidad='".$id_especialidad."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_nom_especialidad ($id_especialidad){
        if (!empty($id_especialidad)){
            $especialidad = $this->ver_especialidad($id_especialidad);
            return $especialidad["nom_especialidad"];
        } else {
            return "No especificado";
        }
    }
    
    public function ver_especialidades () {
        $sql = "SELECT * FROM `especialidades` ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
   
}  
?>