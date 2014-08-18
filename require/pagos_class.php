<?php
require_once ("../require/conexion_class.php");
require_once ("../require/cond_pagos_class.php");

class pagos {
	private $_conexion;
    private $_cond_pagos;
    
	public function __construct (){
		$this->_conexion = new conexion();
        $this->_cond_pagos = new cond_pagos();
	}
    
    public function nuevo ($id_persona, $id_deuda){
        $sql = "INSERT INTO `pagos`(`id_pago`, `id_persona`, `pago`, `id_cond_pago`, `id_deuda`) VALUES (null, '".$id_persona."', '0', '1', '".$id_deuda."' )";
        return $this->_conexion->ejecutar_sentencia($sql);       
    }
    
    public function ver_pagos_int ($id_persona, $id_temporada){
        $sql = "SELECT deudas.id_deuda,deudas.id_temporada,pagos.* FROM deudas,pagos WHERE deudas.id_deuda=pagos.id_deuda AND deudas.id_temporada='".$id_temporada."' AND pagos.id_persona='".$id_persona."' ORDER BY pagos.id_pago ASC ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function num_pagos_int ($id_persona, $id_temporada){
        $this->ver_pagos_int ($id_persona, $id_temporada);
        return $this->_conexion->tam_respuesta();
    }
    
    public function ver_color_cond ($id_cond_pago){
        return $this->_cond_pagos->ver_color($id_cond_pago);
    }
    
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
   
}  
?>