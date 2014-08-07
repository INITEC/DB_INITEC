<?php
require_once ("../require/conexion_class.php");

class usuarios {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function crear_usuario($id_persona){
        $sql = "SELECT id_persona FROM `usuarios` WHERE id_persona='".$id_persona."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        if($this->_conexion->tam_respuesta() > 0 ){
            $sql = "INSERT INTO `usuarios`(`id_usuario`,`id_persona`,`estado`) VALUES (null,'".$id_persona."', 1)";
            if($this->_conexion->ejecutar_sentencia($sql)){
                return $this->ultimo_usuario();    
            }   
        }else {
            return 0;
        }
    }
    public function ultimo_usuario(){
        $sql = "SELECT `id_usuario` FROM `usuarios` ORDER BY id_usuario DESC LIMIT 1";
        $this->_conexion->ejecutar_sentencia($sql);
        $usuario = $this->_conexion->retornar_array();
        return $usuario["id_usuario"];
    }
    public function ingresar_usuario($id_usuario, $usuario){
        $sql = "UPDATE `usuarios` SET usuario='".$usuario."' WHERE id_usuario='".$id_usuario."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
    }
    public function ingresar_clave($id_usuario, $clave){
        $sql = "UPDATE `usuarios` SET clave='".$clave."' WHERE id_usuario='".$id_usuario."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
    }
    public function cambiar_estado($id_persona){
        $sql = "SELECT id_usuario,estado FROM usuarios WHERE id_persona='".$id_persona."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        $estado = $this->_conexion->retornar_array();
        if($estado["estado"]==1){
            $sql = "UPDATE `usuarios` SET estado=0  WHERE id_persona='".$id_persona."' ";
            $this->_conexion->ejecutar_sentencia($sql);
        }else {
            $sql = "UPDATE `usuarios` SET estado=1  WHERE id_persona='".$id_persona."' ";
            $this->_conexion->ejecutar_sentencia($sql);
        }
    }
    public function ver_usuarios (){
		$sql = "SELECT * FROM usuarios ORDER BY orden ASC";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
	public function ver_usuario ($id_persona){
		$sql = "SELECT * FROM usuarios WHERE id_persona = '".$id_persona."'";
		$this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
	}
    public function ingresar_nuevo ($id_persona, $usuario, $clave){
        $id_usuario = $this->crear_usuario($id_persona);
        if($id_usuario != 0){
            if($this->buscar_usuario($usuario) > 0){
                $this->ingresar_usuario($id_persona, $usuario);
                $this->ingresar_clave($id_persona, $clave);
                return "Usuario creado exitosamente";
            }else {
                return "El nombre de usuario ya existe";
            }
        }else {
            return "La persona ya tiene usuario";
        }
    }
    public function buscar_usuario ($usuario){
        $sql = "SELECT usuario FROM usuarios WHERE usuario='".$usuario."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    public function verificar_usuario ($usuario,$clave){
        $sql = "SELECT * FROM usuarios WHERE usuario='".$usuario."' AND clave='".$clave."' AND estado=1 ";
        $this->_conexion->ejecutar_sentencia($sql);
        $usuario = $this->_conexion->tam_respuesta();
        if($usuario == 1){
            return 1;
        }else {
            return 0;
        }
    }
    
    public function obtener_id_persona ($usuario, $clave){
        if($this->verificar_usuario($usuario, $clave) == 1 ){
            $sql = "SELECT * FROM usuarios WHERE usuario='".$usuario."' AND clave='".$clave."' AND estado=1 ";
            $this->_conexion->ejecutar_sentencia($sql);
            $usuario = $this->retornar_SELECT();
            return $usuario["id_persona"];
        } else {
            echo "<script type='text/javascript'>
			alert('El usuario o la clave son incorrectas, o estan deshabilitados porfavor vuelva a intentarlo o consulte con el administrador');
			window.location.assign('index.php');
			</script>";
            return 0;
        }
    }
    
    public function cambiar_clave_persona ($id_persona, $clave_antigua, $clave_nueva){
        $usuario = $this->ver_usuario($id_persona);
        $id_usuario = $usuario["id_usuario"];
        if ($usuario["clave"] == $clave_antigua ){
            $sql="UPDATE `usuarios` SET clave='".$clave_nueva."' WHERE id_usuario='".$id_usuario."' ";
            return $this->_conexion->ejecutar_sentencia($sql);
        } else {
            echo "<script type='text/javascript'>
			alert('La contraseña antigua no conincide en la base de datos');
			window.location='home.php';
			</script>";
            return 0;
        }
    } 
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
    
    
}
?>