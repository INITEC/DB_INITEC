<?php 
require_once ("../require/conexion_class.php");
require_once ("../require/personas_class.php");
require_once ("../require/telefonos_personas_class.php");
require_once ("../require/correos_personas_class.php");
require_once ("../require/universidades_class.php");
require_once ("../require/facultades_class.php");
require_once ("../require/especialidades_class.php");
require_once ("../require/usuarios_class.php");
require_once ("../require/cond_int_class.php");

require_once ("../require/ajuste_primera_palabra_func.php");

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
    public $_cond_int;
    
	public function __construct () {
		$this->_conexion = new conexion();
        $this->_personas = new personas();
        $this->_telefonos_personas = new telefonos_personas();
        $this->_correos_personas = new correos_personas();
        $this->_universidades = new universidades();
        $this->_facultades = new facultades();
        $this->_especialidades = new especialidades();
        $this->_usuarios = new usuarios();
        $this->_cond_int = new cond_int();
	}

	public function establecer_integrante ($id_persona){		
		$this->_persona = $this->_personas->ver_persona ($id_persona);
		$sql = "SELECT * FROM datos_integrantes WHERE id_persona = '".$id_persona."'";
		$this->_conexion->ejecutar_sentencia($sql);
		$this->_datos_integrante = $this->retornar_SELECT();
		
	}
    
	public function foto_int() {
        if(empty($this->_datos_integrante["foto"])){
          return "../foto_integrantes/user.jpg";  
        }else{
		  return "../foto_integrantes/".$this->_datos_integrante["foto"];
        }
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
        $persona = $this->_personas->ver_persona($id_persona);
        return $persona["apellidos"]." ".$persona["nombres"];
    }
    
    public function ver_nombre_corto ($id_persona){
        $persona = $this->_personas->ver_persona($id_persona);
        $apellidos = ajuste_primera_palabra($persona["apellidos"],15,".");
        $nombres = ajuste_primera_palabra($persona["nombres"],15,".");
        $nombre_corto = $apellidos." ".$nombres;
        return $nombre_corto;
    }
    
    public function ver_nombre ($id_persona){
        $persona = $this->_personas->ver_persona($id_persona);
        return $persona["nombres"];
    }
    
    public function ver_apellido ($id_persona){
        $persona = $this->_personas->ver_persona($id_persona);
        return $persona["apellidos"];
    }
    
    public function ver_datos_integrante ($id_persona){
        $sql = "SELECT * FROM datos_integrantes WHERE id_persona='".$id_persona."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_foto ($id_persona){
        $datos_integrante = $this->ver_datos_integrante($id_persona);
        if(empty($datos_integrante["foto"])){
          return "../foto_integrantes/user.jpg";  
        }else{
		  return "../foto_integrantes/".$datos_integrante["foto"];
        }
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
    
    public function ver_telefono_predeterminado ($id_persona){
        return $this->_telefonos_personas->ver_num_telefono($id_persona);
    }
    
    public function ver_telefono_predeterminado_int (){
        return $this->ver_telefono_predeterminado($this->_persona["id_persona"]);
    }
    
    public function ver_correo_predeterminado($id_persona){
        return $this->_correos_personas->ver_direccion_correo($id_persona);
    }
    
    public function ver_correo_predeterminado_int (){
        return $this->ver_correo_predeterminado($this->_persona["id_persona"]);
    }
    
    public function ver_universidad ($id_universidad){
        return $this->_universidades->ver_nom_universidad($id_universidad);
    }
    
    public function ver_universidad_int (){
        return $this->ver_universidad($this->_datos_integrante["id_universidad"]);
    }
    
    public function ver_facultad ($id_facultad){
        return $this->_facultades->ver_nom_facultad($id_facultad);
    }
    
    public function ver_facultad_int (){
        return $this->ver_facultad($this->_datos_integrante["id_facultad"]);
    }
    
    public function ver_especialidad ($id_especialidad){
        return $this->_especialidades->ver_nom_especialidad($id_especialidad);
    }
    
    public function ver_especialidad_int (){
        return $this->ver_especialidad($this->_datos_integrante["id_especialidad"]);
    }
    
    public function ver_cod_universitario_int (){
        return $this->_datos_integrante["cod_universitario"];
    }
    
    public function ver_usuario_int (){
        return $this->_usuarios->ver_nom_usuario($this->_persona["id_persona"]);
    }
    
    public function ver_id_trabajo ($id_persona){
        $integrante = $this->ver_datos_integrante($id_persona);
        return $integrante["id_trabajo"];
    }
    
	public function ver_integrantes (){
		/* datos_integrantes.id_cond_int=1 es considerado como integrante inactivo */
		$sql = "SELECT * FROM personas, datos_integrantes WHERE datos_integrantes.id_cond_int!=1 AND personas.id_persona=datos_integrantes.id_persona ORDER BY personas.apellidos ASC";
		$this->_conexion->ejecutar_sentencia($sql);	
	}
    
    public function num_integrantes (){
        $this->ver_integrantes();
        return $this->_conexion->tam_respuesta();
    }
    
	public function ver_nombres (){ 
        /* datos_integrantes.id_cond_int=1 es considerado como integrante inactivo */
		$sql = "SELECT personas.id_persona, personas.nombres, personas.apellidos datos_integrantes.id_persona datos_integrantes.id_cond_int FROM personas, datos_integrantes WHERE datos_integrantes.id_cond_int!=1 AND datos_integrantes.id_persona=pesonas.id_persona ORDER BY personas.apellidos ASC";
		$this->_conexion->ejecutar_sentencia($sql);	
	}
	
    public function ver_datos_integrantes (){
        $sql = "SELECT * FROM datos_integrantes,cond_int,personas WHERE datos_integrantes.id_cond_int=cond_int.id_cond_int AND personas.id_persona=datos_integrantes.id_persona AND cond_int.id_tipo_cond!='1' ORDER BY personas.apellidos ASC ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function num_datos_integrantes (){
        $this->ver_datos_integrantes();
        return $this->_conexion->tam_respuesta();
    }
    
	public function cambiar_trabajo ($id_persona, $id_trabajo){
		$sql = "UPDATE `datos_integrantes` SET `id_trabajo`='".$id_trabajo."' WHERE `id_persona`= '".$id_persona."' ";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
    
    public function ver_condicion_integrante($id_persona){
        $sql = "SELECT datos_integrantes.*, cond_int.id_cond_int, cond_int.id_tipo_cond FROM datos_integrantes, cond_int WHERE datos_integrantes.id_persona ='".$id_persona."' AND cond_int.id_cond_int=datos_integrantes.id_cond_int";
		$this->_conexion->ejecutar_sentencia($sql);
		$integrante = $this->retornar_SELECT();
        return $integrante["id_tipo_cond"];
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
    
    public function verificar_nom_foto ($nom_foto){
        $sql = "SELECT id_persona,foto FROM datos_integrantes WHERE foto='".$foto."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function obtener_nom_foto_int (){
        if (empty($this->_datos_integrante["foto"])){
            $new_name = idate("U").".jpg";
            while ($this->verificar_nom_foto ($new_name) != 0 ){
                $time = idate("U")+50;
                $new_name = idate("U").".jpg";
            }
            return $new_name;
        } else {
            return $this->_datos_integrante["foto"];
        }
    }
    
    public function guardar_dir_foto_int ($nom_foto){
        $id_persona = $this->_datos_integrante["id_persona"];
        $sql = "UPDATE `datos_integrantes` SET foto='".$nom_foto."' WHERE id_persona='".$id_persona."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function guardar_foto_int($foto){
        $tipo = $foto["type"];
        if($tipo == "image/jpeg" || $tipo == "image/jpg" ){
            //$dimensiones = getimagesize ($ruta_provisional);
            //$ancho = $dimensiones[0];
            //$alto = $dimensiones[1];
            
            $ruta_provisional = $foto["tmp_name"];
            $nom_foto_int = $this->obtener_nom_foto_int();
            $ruta_foto = "../foto_integrantes/".$nom_foto_int;
            
            if(file_exists($ruta_foto)){ //verifica que el archivo existe 
                if(unlink($ruta_foto)){
                    move_uploaded_file ($ruta_provisional ,$ruta_foto);
                    $this->guardar_dir_foto_int ($nom_foto_int);
                    return "La foto fue reemplazada exitosamente, Presiona F5.";
                } else {
                    return "La foto no pudo ser reemplazada.";
                }  
            } else {
                move_uploaded_file ($ruta_provisional ,$ruta_foto);
                $this->guardar_dir_foto_int ($nom_foto_int);
                return "La foto fue guardada exitosamente, Presiona F5.";
            }
            
        } else {
            return "La foto no se guardo, no es del tipo JPG o JPEG";
        }
    }
    
    public function guardar_datos_primarios_int ($nombres, $apellidos){
        $id_persona = $this->_datos_integrante["id_persona"];
        $this->_personas->cambiar_nombre($id_persona, $nombres);
        return $this->_personas->cambiar_apellido($id_persona, $apellidos);
    }
    
    public function guardar_datos_secundarios_int ($linkedin, $DNI, $direccion ){
        $id_persona = $this->_datos_integrante["id_persona"];
        $sql = "UPDATE `datos_integrantes` SET linkedin='".$linkedin."', DNI='".$DNI."', direccion='".$direccion."' WHERE id_persona='".$id_persona."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function guardar_datos_universitarios_int ($id_universidad, $id_facultad, $id_especialidad, $cod_universitario){
        $id_persona = $this->_datos_integrante["id_persona"];
        $sql = "UPDATE `datos_integrantes` SET id_universidad='".$id_universidad."', id_facultad='".$id_facultad."', id_especialidad='".$id_especialidad."', cod_universitario='".$cod_universitario."' WHERE id_persona='".$id_persona."'  ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function guardar_nom_usuario_int ($nom_usuario){
        $id_persona = $this->_datos_integrante["id_persona"];
        return $this->_usuarios->cambiar_nom_usuario($id_persona, $nom_usuario);
    }
    
    public function ingresar_nuevo ($nombres, $apellidos, $usuario, $clave){
        if (empty($usuario)){
            return 0;
        } elseif (empty($clave)){
            return 0;
        } elseif (empty($nombres) && empty($apellidos)){
            return 0;
        } else {
            $this->_personas->ingresar_nuevo($nombres,$apellidos);
            $id_persona = $this->_personas->ultima_persona();
            $this->_usuarios->ingresar_nuevo($id_persona, $usuario, $clave);
            return $this->nuevo($id_persona);
        }
    }
    
    public function nuevo ($id_persona, $id_tipo_cond=3, $id_trabajo=2){
        $this->_cond_int->nuevo($id_tipo_cond,$id_persona);
        $cond_int = $this->_cond_int->ver_ultimo ($id_persona);
        $id_cond_int = $cond_int["id_cond_int"];
        $sql = "INSERT INTO `datos_integrantes` (`id_dato_int`, `id_persona`, `id_cond_int`, `id_trabajo` ) VALUES (null, '".$id_persona."', '".$id_cond_int."', '".$id_trabajo."' ) ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
        public function buscar_integrante_part_nombre ($part_nombre){
        $sql = "SELECT * FROM personas WHERE nombres like '%".$part_nombre."%' OR apellidos like '%".$part_nombre."%' ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}
?>