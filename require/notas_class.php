<?php
require_once ("../require/conexion_class.php");
require_once ("../require/examenes_class.php");

class notas {
	private $_conexion;
    private $_examenes;
	
	public function __construct (){
		$this->_conexion = new conexion();
        $this->_examenes = new examenes();
	}
    
    public function nuevo($id_persona, $id_examen, $nota){
        
        //$notaAprobatoria = $this->_examenes->ver_notaAprobatoria($id_examen);
        $notaAprobatoria = 10;
        if($nota>=$notaAprobatoria){
            $condicion = 1;
        } else {
            $condicion = 0;
        }
        if ($this->verificar_nota($id_persona, $id_examen) == 0 ){
            $sql = "INSERT INTO `notas`(`id_nota`, `nota`, `condicion`, `id_persona`, `id_examen` ) VALUES (null, '".$nota."', '".$condicion."', '".$id_persona."', '".$id_examen."' )";
            return $this->_conexion->ejecutar_sentencia($sql);
        } else {
            return 0;
        }
    }
    
    public function ver_nota_int ($id_persona, $id_examen){
        $sql = "SELECT * FROM `notas` WHERE id_persona='".$id_persona."' AND id_examen='".$id_examen."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function num_notas_int ($id_persona, $id_temporada){
        $this->ver_notas_int($id_persona, $id_temporada);
        return $this->_conexion->tam_respuesta();
    }
    
    public function verificar_nota($id_persona, $id_examen){
        $sql = "SELECT id_persona, id_examen FROM `notas` WHERE id_persona='".$id_persona."' AND id_examen='".$id_examen."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function cambio ($id_nota, $nota ){
        $id_examen = $this->ver_id_examen($id_nota);
        //$notaAprobatoria = $this->_examenes->ver_notaAprobatoria($id_examen);
        $notaAprobatoria = 10;
        if($nota>=$notaAprobatoria){
            $condicion = 1;
        } else {
            $condicion = 0;
        }
        $sql = "UPDATE `notas` SET nota='".$nota."', condicion='".$condicion."' WHERE id_nota='".$id_nota."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_nota ($id_nota){
        $sql = "SELECT * FROM notas WHERE id_nota='".$id_nota."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_id_examen ($id_nota){
        $notas = $this->ver_nota($id_nota);
        return $notas["id_examen"];
    }
    
    public function ver_condicion ($id_nota){
        $notas = $this->ver_nota($id_nota);
        return $notas["condicion"];
    }
    
	public function ver_notas_int ($id_persona, $id_temporada){
		$sql = "SELECT * FROM examenes,notas WHERE id_persona = '".$id_persona."' AND notas.id_examen=examenes.id_examen AND examenes.id_temporada='".$id_temporada."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}
?>