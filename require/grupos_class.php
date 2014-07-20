<?php 
require_once ("../require/conexion_class.php");

class grupos {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion;
	}
	
	public function numero_grupos (){
		$sql = "SELECT estado_grupo FROM grupos WHERE estado_grupo ='1' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
	}
	
	public function ver_grupo ($id_grupo){
		$grupo = $this->datos_grupo($id_grupo);
		return $grupo["nom_grupo"];
	}
	
	public function ver_grupos_encargado ($id_integrante){
		$sql = "SELECT * FROM grupos WHERE estado_grupo ='1' AND encargado='".$id_integrante."' ";
		$this->_conexion->ejecutar_sentencia($sql);
	}
	
	public function datos_grupo ($id_grupo){
		$sql = "SELECT * FROM grupos WHERE id_grupo = '".$id_grupo."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $grupo = $this->_conexion->retornar_array();
	}
	
	private function crear_grupo ($nom_grupo){
		$sql = "INSERT INTO `grupos`(`id_grupo`, `nom_grupo`, `cantidad`, `fecha_creada`, `estado_grupo`) 
					VALUES (null, '".$nom_grupo."', '0', now(), '1')";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
	
	private function buscar_id_grupo ($nom_grupo){
		$sql = "SELECT * FROM grupos WHERE nom_grupo ='".$nom_grupo."' ORDER BY id_grupo DESC LIMIT 1";
		$this->_conexion->ejecutar_sentencia($sql);
		$grupo = $this->_conexion->retornar_array();
		return $grupo["id_grupo"];
	}
	
	public function verificar_grupo ($nom_grupo){
		$sql = "SELECT nom_grupo FROM WHERE nom_grupo ='".$nom_grupo."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
	}
	
	private function cambiar_estado ($id_grupo,$estado){
		$sql = "UPDATE `grupos` SET `estado_grupo`='".$estado."' WHERE id_grupo ='".$id_grupo."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
	
	public function activar_grupo ($id_grupo){
		return $this->cambiar_estado($id_grupo,1);
	}

	public function desactivar_grupo ($id_grupo){
		return $this->cambiar_estado($id_grupo,0);
	}
	
	public function nuevo_grupo ($nom_grupo){
		if($this->verificar_grupo($nom_grupo) == 0){
			$this->crear_grupo($nom_grupo);}
		return $this->buscar_id_grupo($nom_grupo);
	}
	
	public function ver_grupos (){
		$sql = "SELECT * FROM grupos WHERE estado_grupo ='1'";
		$this->_conexion->ejecutar_sentencia($sql);
	}
	
	public function ver_grupos_todos (){
		$sql = "SELECT * FROM grupos ";
		$this->_conexion->ejecutar_sentencia($sql);
	}
	
	public function verificar_integrante ($id_integrante, $id_grupo){
		$sql = "SELECT * FROM lista_grupos WHERE id_integrante ='".$id_integrante."' AND id_grupo ='".$id_grupo."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		return $this->_conexion->tam_respuesta();
	}
	
	private function variar_cantidad ($id_grupo, $cantidad){
		$sql = "UPDATE grupos SET cantidad = cantidad + ".$cantidad." WHERE id_grupo ='".$id_grupo."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
	
	public function retirar_integrante ($id_integrante, $id_grupo){
		if($this->verificar_integrante($id_integrante, $id_grupo) != 0 ) {
		$sql = "DELETE FROM `lista_grupos` WHERE id_integrante ='".$id_integrante."' AND id_grupo ='".$id_grupo."'";
		if($this->_conexion->ejecutar_sentencia($sql)){
			if($this->verificar_integrante ($id_integrante, $id_grupo) == 0){
				$this->variar_cantidad($id_grupo, -1);
				return 1;
			}else {
				$this->retirar_integrante ($id_integrante, $id_grupo);
			}
		}else {
			return 0;
		}}
		else {
			return 1;
		}
	}
	
	private function agregar_integrante ($id_integrante,$id_grupo){
		$sql = "INSERT INTO `lista_grupos`(`id_lista`, `id_integrante`, `id_grupo`) 
					VALUES (null, '".$id_integrante."', '".$id_grupo."')";
		$this->variar_cantidad($id_grupo,1);
		return $this->_conexion->ejecutar_sentencia($sql);
	}
	
	public function verificar_registrar ($id_integrante, $id_grupo) {
		if ($this->verificar_integrante($id_integrante, $id_grupo) == 0){
			return $this->agregar_integrante($id_integrante, $id_grupo);
		} else {
			return 1;
		}
	}
	
	public function ver_integrantes ($id_grupo){
		$sql = "SELECT integrantes.*,lista_grupos.* FROM integrantes,lista_grupos WHERE integrantes.id_integrantes=lista_grupos.id_integrante
					AND lista_grupos.id_grupo ='".$id_grupo."' ";
		return $this->ejecutar_sentencia($sql);
	}
	
	public function retornar_SELECT (){
		return $this->_conexion->retornar_array();
	}
	
}

?>