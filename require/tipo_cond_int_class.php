<?php
require_once ("../require/conexion_class.php");

class tipo_cond_int {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    /* Crea un nuevo tipo de condicion de integrante y retorna un true o false dependiendo 
    de si se guardo el valor en la base de datos */
    public function nuevo($nombre_tipo){
        if ($this->buscar($nombre_tipo) == 0){
            $sql = "INSERT INTO `tipo_cond_int` (`id_tipo_cond`, `nombre_tipo`) VALUES (null, '".$nombre_tipo."')";
            return $this->_conexion->ejecutar_sentencia($sql);
        }
    }
    /* Busca en la tabla de tipos de condicion de integrantes si se encuentra un nombre 
    igual a $nombre_tipo y retorna el numero de cuantos tipos hay con ese nombre */
    public function buscar($nombre_tipo){
        $sql = "SELECT id_tipo_cond,nombre_tipo FROM `tipo_cond_int` WHERE nombre_tipo='".$nombre_tipo."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    /* Ejecuta la sentencia de pedir todos los tipos con todos sus demas campos*/
    public function ver_tipos (){
		$sql = "SELECT * FROM `tipos_cond_int` ORDER BY nombre_tipo ASC";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
    
    /* Consulta la existencia de un determinado tipo de condicion */
	public function ver_tipo ($id_tipo_cond){
		$sql = "SELECT * FROM `tipo_cond_int` WHERE id_tipo_cond = '".$id_tipo_cond."' LIMIT 1 ";
		$this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
	}
    
    public function ver_nombre ($id_tipo_cond){
        $tipo = $this->ver_tipo($id_tipo_cond);
        return $tipo["nombre_tipo"];
    }
    
    /* Retorna el array del metodo que se ejecuto antes, este metodo debe ser de consulta a la
    base de datos utilizando un SELECT */
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}
?>