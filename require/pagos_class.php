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
    
    public function variar_pago_int ($id_persona, $id_deuda, $pago, $id_cond_pago){
        $sql = "UPDATE `pagos` SET pago = pago + ".$pago.", id_cond_pago='".$id_cond_pago."' WHERE id_persona='".$id_persona."' AND id_deuda='".$id_deuda."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function registrar_pago_int ($id_persona, $id_deuda, $pago, $monto_deuda){
        $dato_pago = $this->ver_pago_int($id_persona, $id_deuda);
        $nuevo_valor = $dato_pago["pago"] + $pago;
        if ($nuevo_valor >= $monto_deuda ){
            $condicion = 3;
        } elseif ($nuevo_valor > 0){
            $condicion = 2;
        } else {
            $condicion = 1;
        }
        return $this->variar_pago_int($id_persona, $id_deuda, $pago, $condicion);
    }
    
    public function ver_pagos_int ($id_persona, $id_temporada){
        $sql = "SELECT deudas.id_deuda,deudas.id_temporada,pagos.* FROM deudas,pagos WHERE deudas.id_deuda=pagos.id_deuda AND deudas.id_temporada='".$id_temporada."' AND pagos.id_persona='".$id_persona."' ORDER BY pagos.id_pago ASC ";
        $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_pago_int ($id_persona, $id_deuda){
        $sql = "SELECT * FROM `pagos` WHERE id_persona='".$id_persona."' AND id_deuda='".$id_deuda."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function verificar_pago_int ($id_persona, $id_deuda){
        $sql = "SELECT * FROM `pagos` WHERE id_persona='".$id_persona."' AND id_deuda='".$id_deuda."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->_conexion->tam_respuesta();
    }
    
    public function num_pagos_int ($id_persona, $id_temporada){
        $this->ver_pagos_int ($id_persona, $id_temporada);
        return $this->_conexion->tam_respuesta();
    }
    
    public function ver_class_cond ($id_cond_pago){
        return $this->_cond_pagos->ver_class_css($id_cond_pago);
    }
    
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
   
}  
?>