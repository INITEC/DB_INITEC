<?php 
require_once ("../require/conexion_class.php");

class cond_hora {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
	
    public function ver_cond_hora($id_cond_hora){
        $sql = "SELECT * FROM cond_hora WHERE id_cond_hora='".$id_cond_hora."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_nom_cond ($id_cond_hora){
        $cond_hora = $this->ver_cond_hora($id_cond_hora);
        return $cond_hora["nombre_cond"];
    }
    
    public function ver_color_cond ($id_cond_hora){
        $cond_hora = $this->ver_cond_hora($id_cond_hora);
        return $cond_hora["cod_color"];
    }
	
    public function ver_cond_horas (){
        $sql = "SELECT * FROM cond_hora WHERE estado='1' ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function num_cond_horas (){
        $this->ver_cond_horas();
        $this->_conexion->tam_respuesta();
    }
    
	public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}

}
?>