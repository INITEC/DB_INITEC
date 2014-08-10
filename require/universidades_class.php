<?php
require_once ("../require/conexion_class.php");

class universidades {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function nuevo ($nom_universidad ){
        if ($this->verificar_nombre($nom_universidad) == 0 ) {
            $sql = "INSERT INTO `universidades` (`id_universidad`, `nom_universidad`) VALUES (null, '".$nom_universidad."')";
            $this->_conexion->ejecutar_sentencia();
            $universidad = $this->ver_ultima_universidad($nom_universidad);
            return $universidad["id_universidad"];
        } else {
            echo "<script type='text/javascript' language='javascript' >
            alert ('El nombre de la universidad ya existe');
			</script>";
            $universidad = $this->ver_ultima_universidad($nom_universidad);
            return $universidad["id_universidad"];
        }
    }
    
    public function ver_ultima_universidad ($nom_universidad){
        $sql = "SELECT * FROM universidades WHERE nom_universidad='".$nom_universidad."' ORDER BY id_universidad DESC LIMIT 1";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function cambiar_nom_universidad ($id_universidad, $nom_universidad){
        $sql = "UPDATE `universidades` SET `nom_universidad`='".$nom_universidad."' WHERE `id_universidad`= '".$id_universidad."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function cambiar_abreviatura ($id_universidad, $abreviatura){
        $sql = "UPDATE `universidades` SET `abreviatura`='".$abreviatura."' WHERE `id_universidad`= '".$id_universidad."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function verificar_nombre ($nom_universidad) {
        $sql = "SELECT nom_universidad FROM `universidades` WHERE nom_universidad='".$nom_universidad."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function ver_universidad ($id_universidad){
        $sql = "SELECT * FROM `universidades` WHERE id_universidad='".$id_universidad."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_nom_universidad ($id_universidad){
        if (!empty($id_facultad)){
            $universidad = $this->ver_universidad($id_universidad);
            return $universidad["nom_universidad"];
        } else {
            return "No especificado";
        }
    }
    
    public function ver_abreviatura ($id_universidad){
        $universidad = $this->ver_universidad($id_universidad);
        return $universidad["abreviatura"];
    }
    
    public function ver_universidades () {
        $sql = "SELECT * FROM `universidades` ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function cant_universidades (){
        $this->ver_universidades();
        return $this->_conexion->tam_respuesta();
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
   
}  
?>