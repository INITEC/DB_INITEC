<?php
require_once ("../require/conexion_class.php");
require_once ("../require/operadores_telefono_class.php");

class correos_personas {
	private $_conexion;
    
	public function __construct (){
		$this->_conexion = new conexion();
    }
    
    // predeterminado -> 1 = si -> 2 = no
    public function nuevo ($correo, $id_persona, $predeterminado=1){
        if ($this->verificar_correo($correo) == 0) {
            if ($predeterminado == 1 ){
                $this->quitar_predeterminados($id_persona);
            }else {$predeterminado = 2;}

            $sql = "INSERT INTO `correos_personas` (`id_correo_per`, `correo`,`id_persona`, `predeterminado`) VALUES (null, '".$correo."', '".$id_persona."', '".$predeterminado."')";
            return $this->_conexion->ejecutar_sentencia($sql);
        } else {
            echo "<script type='text/javascript' language='javascript' >
            alert ('El correo ya ha sido registrado antes');
			</script>";
            return 0;
        }
    }
    
    public function quitar_predeterminados ($id_persona){
        $sql = "UPDATE `correos_personas` SET `predeterminado`='2' WHERE `id_persona`= '".$id_persona."' AND predeterminado='1' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function verificar_correo ($correo) {
        $sql = "SELECT correo FROM `correos_personas` WHERE correo='".$correo."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function verificar_predeterminado ($id_persona) {
        $sql = "SELECT * FROM `correos_personas` WHERE id_persona='".$id_persona."' AND predeterminado='1' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function cant_correos ($id_persona) {
        $this->ver_correos($id_persona);
        return $this->_conexion->tam_respuesta();
    }
    
    public function ver_correos ($id_persona){
        $sql = "SELECT * FROM `correos_personas` WHERE id_persona='".$id_persona."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_correo ($id_persona){
        // predeterminado -> 1 = si -> 2 = no
        if($this->verificar_predeterminado($id_persona) != 0){
            $sql = "SELECT * FROM `correos_personas` WHERE id_persona='".$id_persona."' AND predeterminado='1' LIMIT 1 ";
            $this->_conexion->ejecutar_sentencia($sql);
            return $this->retornar_SELECT();
        } else {
            if ($this->cant_correos($id_persona) !=0){
                $sql = "SELECT * FROM `correos_personas` WHERE id_persona='".$id_persona."' ORDER BY id_correo_per DESC LIMIT 1";
                $this->_conexion->ejecutar_sentencia($sql);
                return $this->retornar_SELECT();
            } else {
                return 0;
            }
        }
    }
    
    public function ver_direccion_correo ($id_persona){
        $correo = $this->ver_correo($id_persona);
        if ($correo != 0){
            return $correo["correo"]; 
        } else {
            return "sin correo";
        }
    }
    
    public function hacer_predeterminado ($id_correo, $id_persona){
        $this->quitar_predeterminados($id_persona);
        $sql = "UPDATE `correos_personas` SET `predeterminado`='1' WHERE `id_persona`='".$id_persona."' AND id_correo_per='".$id_correo."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
    
}  
?>