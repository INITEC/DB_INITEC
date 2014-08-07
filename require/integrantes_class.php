<?php 
require_once ("../require/conexion_class.php");
require_once ("../require/personas_class.php");
require_once ("../require/telefonos_personas_class.php");
require_once ("../require/correos_personas_class.php");
require_once ("../require/universidades_class.php");
require_once ("../require/facultades_class.php");
require_once ("../require/especialidades_class.php");
require_once ("../require/usuarios_class.php");

class integrantes {
	private $_conexion;
    private $_personas;
	private $_telefonos_personas;
    private $_correos_personas;
    private $_universidades;
    private $_facultades;
    private $_especialidades;
    private $_usuarios;
	public $_persona;
	public $_datos_integrante;
    
	public function __construct () {
		$this->_conexion = new conexion();
        $this->_personas = new personas();
        $this->_telefonos_personas = new telefonos_personas();
        $this->_correos_personas = new correos_personas();
        $this->_universidades = new universidades();
        $this->_facultades = new facultades();
        $this->_especialidades = new especialidades();
        $this->_usuarios = new usuarios();
	}

	public function establecer_integrante ($id_persona){		
		$this->_persona = $this->_personas->ver_persona ($id_persona);
		$sql = "SELECT * FROM datos_integrantes WHERE id_persona = '".$id_persona."'";
		$this->_conexion->ejecutar_sentencia($sql);
		$this->_datos_integrante = $this->retornar_SELECT();
		
	}
    
	public function foto() {
		return "../foto_integrantes/".$this->_datos_integrante["foto"];
	}
    
	public function retornar_id_trabajo (){
		return $this->_datos_integrante["id_trabajo"];
	}
    
    public function ver_nombre_int (){
        return $this->_persona["nombres"];
    }
    
    public function ver_direccion_int (){
        return $this->_datos_integrante["direccion"];
    }
    
    public function ver_nombre_completo ($id_persona){
        $sql = "SELECT * FROM personas WHERE id_persona='".$id_persona."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        $persona = $this->retornar_SELECT();
        return $persona["apellidos"]." ".$persona["nombres"];
    }
    
    public function ver_apellido_int (){
        return $this->_persona["apellidos"];
    }
    
    public function ver_linkedin_int (){
        return $this->_datos_integrante["linkedin"];
    }
    
    public function ver_DNI_int (){
        return $this->_datos_integrante["DNI"];
    }
    
    public function ver_telefono_predeterminado_int (){
        return $this->_telefonos_personas->ver_num_telefono($this->_persona["id_persona"]);
    }
    
    public function ver_correo_predeterminado_int (){
        return $this->_correos_personas->ver_direccion_correo($this->_persona["id_persona"]);
    }
    
    public function ver_universidad_int (){
        return $this->_universidades->ver_nom_universidad($this->_datos_integrante["id_universidad"]);
    }
    
    public function ver_facultad_int (){
        return $this->_facultades->ver_nom_facultad($this->_datos_integrante["id_facultad"]);
    }
    
    public function ver_especialidad_int (){
        return $this->_especialidades->ver_nom_especialidad($this->_datos_integrante["id_especialidad"]);
    }
    
    public function ver_cod_universitario_int (){
        return $this->_datos_integrante["cod_universitario"];
    }
    
    public function ver_usuario_int (){
        return $this->_usuarios->ver_nom_usuario($this->_persona["id_persona"]);
    }
    
	public function ver_integrantes (){
		/* datos_integrantes.id_cond_int=1 es considerado como integrante inactivo */
		$sql = "SELECT * FROM personas, datos_integrantes WHERE datos_integrantes.id_cond_int=1 AND personas.id_persona=datos_integrantes.id_persona ORDER BY personas.apellidos ASC";
		$this->_conexion->ejecutar_sentencia($sql);	
	}
    
	public function ver_nombres (){ 
        /* datos_integrantes.id_cond_int=1 es considerado como integrante inactivo */
		$sql = "SELECT personas.id_persona, personas.nombres, personas.apellidos datos_integrantes.id_persona datos_integrantes.id_cond_int FROM personas, datos_integrantes WHERE datos_integrantes.id_cond_int=1 AND datos_integrantes.id_persona=pesonas.id_persona ORDER BY personas.apellidos ASC";
		$this->_conexion->ejecutar_sentencia($sql);	
	}
	
	public function cambiar_trabajo ($id_persona, $id_trabajo){
		$sql = "UPDATE `datos_integrantes` SET `id_trabajo`='".$id_trabajo."' WHERE `id_persona`= '".$id_persona."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
    
    public function ver_condicion_integrante($id_persona){
        $sql = "SELECT id_persona,id_condicion_int FROM datos_integrante WHERE id_persona ='".$id_persona."' ";
		$this->_conexion->ejecutar_sentencia($sql);
		$integrante = $this->retornar_SELECT();
        return $integrante["id_cond_int"];
    }
    
    public function cambiar_condicion_integrante($id_persona, $id_cond_int){
        $sql = "UPDATE `datos_integrantes` SET id_cond_int='".$id_cond_int."' WHERE id_persona='".$id_persona."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
	public function verificar_activo($id_persona){
        /* datos_integrantes.id_cond_int=1 es considerado como integrante inactivo */
	   if($this->ver_condicion_integrante($id_persona)==1){
            return 0;
       }else{
            return 1;
       }	
	}
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}
?>