<?php
require_once ("../require/conexion_class.php");
require_once ("../require/operadores_telefono_class.php");

class telefonos_personas {
	private $_conexion;
    private $_operadores_telefono;
	
	public function __construct (){
		$this->_conexion = new conexion();
        $this->_operadores_telefono = new operadores_telefono();
	}
    
    // $movil -> 1 = movil -> 2 = fijo
    // prederterminado -> 1 = si -> 2 = no
    public function nuevo ($telefono, $movil, $id_operador, $id_persona, $predeterminado){
        if ($this->verificar_telefono($telefono) == 0 and $this->_operadores_telefono->verificar_operador($id_operador) == 0) {
            if ($predeterminado == 1 ){
                $this->quitar_predeterminados($id_persona);
            }else {$predeterminado = 2;}
            if ($movil != 1){
                $movil = 2;
            }
            
            $sql = "INSERT INTO `telefonos_personas` (`id_telefono_per`, `telefono`, `movil`, `id_operador`, `id_persona`, `prederterminado`) VALUES (null, '".$telefono."', '".$movil."', '".$id_operador."', '".$id_persona."', '".$predeterminado."')";
            return $this->_conexion->ejecutar_sentencia();
        } else {
            echo "<script type='text/javascript' language='javascript' >
            alert ('Datos no validos, es posible que el telefono se repita o no exista el operador elegido');
			</script>";
            return 0;
        }
    }
    
    public function quitar_predeterminados ($id_persona){
        $sql = "UPDATE `telefonos_personas` SET `prederterminado`='2' WHERE `id_persona`= '".$id_persona."' AND prederterminado='1' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function verificar_telefono ($telefono) {
        $sql = "SELECT telefono FROM `telefonos_personas` WHERE telefono='".$telefono."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function ver_nom_operador ($id_operador){
        return $this->_operadores_telefono->ver_nom_operador($id_operador);
    }
    
    public function verificar_predeterminado ($id_persona) {
        $sql = "SELECT * FROM `telefonos_personas` WHERE id_persona='".$id_persona."' AND prederterminado='1' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function cant_telefonos ($id_persona) {
        $this->_ver_telefonos($id_persona);
        return $this->_conexion->tam_respuesta();
    }
    
    public function ver_telefonos ($id_persona){
        $sql = "SELECT * FROM `telefonos_personas` WHERE id_persona='".$id_persona."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_telefono ($id_persona){
        // prederterminado -> 1 = si -> 2 = no
        if($this->verificar_predeterminado($id_persona) != 0){
            $sql = "SELECT * FROM `telefonos_personas` WHERE id_persona='".$id_persona."' AND prederterminado='1' LIMIT 1 ";
            $this->_conexion->ejecutar_sentencia($sql);
            return $this->retornar_SELECT();
        } else {
            if ($this->cant_telefonos($id_persona) !=0){
                $sql = "SELECT * FROM `telefonos_personas` WHERE id_persona='".$id_persona."' ORDER BY id_telefono_per DESC LIMIT 1";
                $this->_conexion->ejecutar_sentencia($sql);
                return $this->retornar_SELECT();
            } else {
                return 0;
            }
        }
    }
    
    public function ver_num_telefono ($id_persona){
        $telefono = $this->ver_telefono($id_persona);
        if ($telefono != 0){
            return $telefono["telefono"]; 
        } else {
            return "sin telefono";
        }
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
    
}  
?>