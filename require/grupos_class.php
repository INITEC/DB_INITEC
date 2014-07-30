<?php 
require_once ("../require/conexion_class.php");
require_once ("../require/lista_grupos_class.php");

class grupos {
	private $_conexion;
    private $_lista_grupos;
	
	public function __construct (){
		$this->_conexion = new conexion;
        $this->_lista_grupos = new lista_grupos;
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
		return $grupo = $this->retornar_SELECT();
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
	
	public function verificar_integrante ($id_persona, $id_grupo){
		return $this->_lista_grupos->verificar_integrante($id_persona, $id_grupo);
	}
	
	private function variar_cantidad ($id_grupo, $cantidad){
		$sql = "UPDATE grupos SET cantidad = cantidad + ".$cantidad." WHERE id_grupo ='".$id_grupo."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
	
	public function retirar_integrante ($id_persona, $id_grupo){
		if($this->verificar_integrante($id_persona, $id_grupo) != 0 ) {
            if($this->_lista_grupos->retirar_integrante($id_integrante, $id_grupo)){
                if($this->verificar_integrante ($id_persona, $id_grupo) == 0){
                    $this->variar_cantidad($id_grupo, -1);
                    return 1;
                }else {
                    $this->retirar_integrante ($id_persona, $id_grupo);
                }
            }else {
                return 0;
            }
        }
		else {
			return 1;
		}
	}
	
	private function agregar_integrante ($id_persona,$id_grupo){
        $this->_lista_grupos->agregar_integrante($id_persona, $id_grupo);
        return $this->variar_cantidad($id_grupo,1);
	}
	
	public function verificar_registrar ($id_integrante, $id_grupo) {
		if ($this->verificar_integrante($id_integrante, $id_grupo) == 0){
			return $this->agregar_integrante($id_integrante, $id_grupo);
		} else {
			return 1;
		}
	}

	public function retornar_SELECT (){
		return $this->_conexion->retornar_array();
	}
	
}

?>