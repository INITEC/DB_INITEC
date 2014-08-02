<?php
require_once ("../require/conexion_class.php");

class cond_asist {
	private $_conexion;
	
	public function __construct (){
		$this->_conexion = new conexion();
	}
    
    public function nuevo($nom_condicion, $asistencia, $cod_color){
        if ($this->buscar($nom_condicion, $asistencia) == 0){
            // asistencia -> 1=asistio 2=no asistio
            if ($asistencia != 1){
                $asistencia = 2;
            }
            $orden = $this->ultimo_orden() + 1 ;
            $sql = "INSERT INTO `cond_asist` (`id_cond_asist`, `nom_condicion`, `asistencia`, `estado`, `orden`, `cod_color`) VALUES (null, '".$nom_condicion."', '".$asistencia."', '1', '".$orden."', '".$cod_color."' ) ";
            return $this->_conexion->ejecutar_sentencia($sql);
        } else {
            echo "<script type='text/javascript' language='javascript' >
            alert ('La condicion de asistecia ya existe');
			</script>";
            return 0;
        }
    }

    public function buscar($nom_condicion, $asistencia){
        $sql = "SELECT nom_condicion, asistencia FROM `cond_asist` WHERE nom_condicion='".$nom_condicion."' AND asistencia='".$asistencia."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function ultimo_orden (){
        $sql = "SELECT orden FROM `cond_asist` ORDER BY orden DESC LIMIT 1";
        $this->_conexion->ejecutar_sentencia($sql);
        $orden = $this->retornar_SELECT();
        return $orden["orden"];
    }
    
    public function cambiar_orden ($id_cond_asist, $orden_new) {
        $sql = "UPDATE `cond_asist` SET orden=orden+1 WHERE orden >= '".$orden_new."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        $sql = "UPDATE `cond_asist` SET orden='".$orden."' WHERE id_cond_asist='".$id_cond_asist."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_condiciones (){
        // estado -> 1=activo ->2=inactivo
		$sql = "SELECT * FROM `cond_asist` WHERE estado='1'  ORDER BY nom_condicion ASC";
		return $this->_conexion->ejecutar_sentencia($sql);
	}
    
    public function ver_condicion ($id_cond_asist){
		$sql = "SELECT * FROM `cond_asist` WHERE id_cond_asist = '".$id_cond_asist."' LIMIT 1 ";
		$this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
	}
    
    public function ver_nom_condicion ($id_cond_asist){
        $condicion = $this->ver_condicion($id_cond_asist);
        return $condicion["nom_condicion"];
    }
    
    public function ver_asistencia ($id_cond_asist){
        // asistencia -> 1=asistio 2=no asistio
        $condicion = $this->ver_condicion($id_cond_asist);
        if ($condicion["asisitencia"] = 1){
            return "ASISTIO";
        } else if ($condicion["asistencia"] == 2){
            return "NO ASISTIO";
        }
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
}
?>