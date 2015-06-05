<?php
require_once ("../require/conexion_class.php");

class examenes {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function nuevo($nombre_examen, $fecha_examen, $n_maxima, $n_aprovatoria, $id_temporada){
        $sql = "INSERT INTO `examenes`(`id_examen`, `examen`, `fecha`, `n_maxima`, `n_aprobatoria`, `id_temporada`) VALUES (null, '".$nombre_examen."', '".$fecha_examen."', '".$n_maxima."', '".$n_aprovatoria."', '".$id_temporada."' )";
            return $this->_conexion->ejecutar_sentencia($sql);
    }

    public function cambio ($id_examen, $nombre_examen, $fecha_examen, $n_maxima, $n_aprovatoria ){
        $sql = "UPDATE `examenes` SET examen='".$nombre_examen."', fecha='".$fecha_examen."', n_maxima='".$n_maxima."', n_aprovatoria='".$n_aprovatoria."' WHERE id_examen='".$id_examen."' ";
            return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_examenes ($id_temporada){
		$sql = "SELECT * FROM `examenes` WHERE id_temporada='".$id_temporada."' ORDER BY id_examen DESC";
		return $this->_conexion->ejecutar_sentencia($sql);		
	}
    
    public function ver_todo (){
        $sql = "SELECT * FROM `examenes` ";
		return $this->_conexion->ejecutar_sentencia($sql);		
    }
    
    public function ver_examen ($id_examen) {
        $sql = "SELECT * FROM `examenes` WHERE id_examen='".$id_examen."' ";
		$this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_notaAprobarotia ($id_examen){
        $examen = $this->ver_examen($id_examen);
        return $examen["n_aprobatoria"];
    }
    public function ver_fecha ($id_examen){
        $examen = $this->ver_examen($id_examen);
        return $examen["fecha"];
    }
    public function ver_notaMaxima ($id_examen){
        $examen = $this->ver_examen($id_examen);
        return $examen["n_maxima"];
    }
    public function ver_nombreExamen ($id_examen){
        $examen = $this->ver_examen($id_examen);
        return $examen["examen"];
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}
?>