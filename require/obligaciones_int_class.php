<?php 
require_once ("../require/conexion_class.php");

class obligaciones_int {
	private $_conexion;
	private $_id_trabajo;
	public function __construct () {
		$this->_conexion = new conexion();
	}
	public function buscar_obligaciones ($id_trabajo){
		$this->_id_trabajo = $id_trabajo;
		$sql = "SELECT * FROM obligaciones_int,tareas_int WHERE obligaciones_int.id_trabajo = '".$this->_id_trabajo."' 
					AND obligaciones_int.id_tarea = tareas_int.id_tarea ORDER BY tareas_int.orden ASC ";
		$this->_conexion->ejecutar_sentencia($sql);
	}
    
    public function ver_primera_obligacion ($id_trabajo){
        $sql = "SELECT * FROM obligaciones_int,tareas_int WHERE obligaciones_int.id_trabajo = '".$id_trabajo."' 
					AND obligaciones_int.id_tarea = tareas_int.id_tarea ORDER BY tareas_int.orden ASC LIMIT 1 ";
		$this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
	public function retornar_SELECT (){
		return $this->_conexion->retornar_array();
	}
	public function verificar_tarea($id_trabajo,$nom_tarea) {
		$sql = "SELECT * FROM obligaciones_int,tareas_int WHERE obligaciones_int.id_trabajo = '".$id_trabajo."'
				AND obligaciones_int.id_tarea = tareas_int.id_tarea AND tareas_int.nom_tarea = '".$nom_tarea."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
	}
	public function crear_obligacion($id_trabajo, $id_tarea) {
		$sql = "SELECT * FROM obligaciones_int WHERE id_trabajo= '".$id_trabajo."' AND id_tarea= '".$id_tarea."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		if($this->_conexion->tam_respuesta() != 0 ) {
			echo "<script type='text/javascript' language='javascript' >
						alert ('Esa tarea ya esta asignada al trabajo');
						</script>";
			return 0;
		} else {
			$sql = "INSERT INTO `obligaciones_int`(`id_obligacion`, `id_trabajo`, `id_tarea`) 
						VALUES (null, '".$id_trabajo."', '".$id_tarea."')";
			return $this->_conexion->ejecutar_sentencia($sql);
		}
	}
	public function eliminar_obligacion ($id_trabajo, $id_tarea) {
		$sql = "SELECT * FROM obligaciones_int WHERE id_trabajo= '".$id_trabajo."' AND id_tarea= '".$id_tarea."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		if($this->_conexion->tam_respuesta() != 0 ) {
			$sql = "DELETE FROM `obligaciones_int` WHERE id_trabajo='".$id_trabajo."' AND  id_tarea= '".$id_tarea."' ";
			return $this->_conexion->ejecutar_sentencia($sql);
		} else {
				echo "<script type='text/javascript' language='javascript' >
						alert ('Esa tarea no habia estado asignada a ese trabajo');
						</script>";
				return 0;
			}
	}

}

?>