<?php
require_once ("../require/conexion_class.php");

class facultades {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function nuevo ($nom_facultad){
        if ($this->verificar_nombre($nom_facultad) == 0 ) {
            $sql = "INSERT INTO `facultades` (`id_facultad`, `nom_facultad`) VALUES (null, '".$nom_facultad."' )";
            $this->_conexion->ejecutar_sentencia($sql);
            $facultad = $this->ver_ultima_facultad($nom_facultad);
            return $facultad["id_facultad"];
        } else {
            echo "<script type='text/javascript' language='javascript' >
            alert ('El nombre de la facultad ya existe');
			</script>";
            $facultad = $this->ver_ultima_facultad($nom_facultad);
            return $facultad["id_facultad"];
        }
    }
    
    public function ver_ultima_facultad ($nom_facultad){
        $sql = "SELECT * FROM facultades WHERE nom_facultad='".$nom_facultad."' ORDER BY id_facultad DESC LIMIT 1";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function cambiar_nom_facultad ($id_facultad, $nom_facultad){
        $sql = "UPDATE `facultades` SET `nom_facultad`='".$nom_facultad."' WHERE `id_facultad`= '".$id_facultad."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function cambiar_abreviatura ($id_facultad, $abreviatura){
        $sql = "UPDATE `facultades` SET `abreviatura`='".$abreviatura."' WHERE `id_facultad`= '".$id_facultad."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function verificar_nombre ($nom_facultad) {
        $sql = "SELECT nom_facultad FROM `facultades` WHERE nom_facultad='".$nom_facultad."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function ver_facultad ($id_facultad){
        $sql = "SELECT * FROM `facultades` WHERE id_facultad='".$id_facultad."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_nom_facultad ($id_facultad){
        if (!empty($id_facultad)){
            $facultad = $this->ver_facultad ($id_facultad);
            return $facultad["nom_facultad"];
        } else {
            return "No especificado";
        }
    }
    
    public function ver_abreviatura ($id_facultad){
        $facultad = $this->ver_facultad($id_facultad);
        return $facultad["abreviatura"];
    }
    
    public function ver_facultades () {
        $sql = "SELECT * FROM `facultades` ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function cant_facultades (){
        $this->ver_facultades();
        return $this->_conexion->tam_respuesta();
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
   
}  
?>