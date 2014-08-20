<?php
require_once ("../require/conexion_class.php");
require_once ("../require/lista_grupos_class.php");
require_once ("../require/pagos_class.php");

class deudas {
	private $_conexion;
    private $_lista_grupos;
    private $_pagos;
    
	public function __construct (){
		$this->_conexion = new conexion();
        $this->_lista_grupos = new lista_grupos();
        $this->_pagos = new pagos();
    }
    
    public function nueva ($nombre_deuda, $fecha_final, $fecha_creada, $monto_total, $id_temporada, $id_cobrador, $id_grupo){
        $sql = "INSERT INTO `deudas`(`id_deuda`, `nombre_deuda`, `fecha_final`, `fecha_creada`, `monto_total`, `id_temporada`, `id_cobrador`, `estado`, `id_grupo`) VALUES (null, '".$nombre_deuda."', '".$fecha_final."', '".$fecha_creada."', '".$monto_total."', '".$id_temporada."','".$id_cobrador."', '1' , '".$id_grupo."' ) ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_ultima_deuda ($nombre_deuda, $fecha_creada, $id_temporada){
        $sql = "SELECT * FROM `deudas` WHERE nombre_deuda='".$nombre_deuda."' AND fecha_creada='".$fecha_creada."' AND  id_temporada='".$id_temporada."' AND estado='1' ORDER BY id_deuda DESC LIMIT 1 ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function ver_deudas ($id_temporada){
        $sql = "SELECT * FROM `deudas` WHERE id_temporada='".$id_temporada."' AND estado='1' ORDER BY id_deuda DESC ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function ver_deuda ($id_deuda){
        $sql = "SELECT * FROM deudas WHERE id_deuda='".$id_deuda."' ";
        $this->_conexion->ejecutar_sentencia($sql);
        return $this->retornar_SELECT();
    }
    
    public function cambio ($id_deuda, $nombre_deuda, $fecha_final, $monto_total, $id_cobrador, $id_temporada){
        $sql="UPDATE deudas SET nombre_deuda='".$nombre_deuda."', fecha_final='".$fecha_final."', monto_total='".$monto_total."', id_cobrador='".$id_cobrador."' WHERE id_deuda='".$id_deuda."' ";
        return $this->_conexion->ejecutar_sentencia($sql);
    }
    
    public function crear_nueva_deuda ($nombre_deuda, $fecha_final, $fecha_creada, $monto_total, $id_temporada, $id_cobrador, $id_grupo){
        if($this->nueva($nombre_deuda, $fecha_final, $fecha_creada, $monto_total, $id_temporada, $id_cobrador, $id_grupo)){
            $deuda = $this->ver_ultima_deuda($nombre_deuda, $fecha_creada, $id_temporada);
            $id_deuda = $deuda["id_deuda"];
            $id_grupo = $deuda["id_grupo"];
            $resultado = 1;

            $this->_lista_grupos->ver_lista($id_grupo);
            while ($lista = $this->_lista_grupos->retornar_SELECT()){
                $id_persona = $lista["id_persona"];
                if($this->_pagos->nuevo ($id_persona,$id_deuda)){
                    $resultado = $resultado*1;
                } else {
                    $resultado = $resultado*0;
                }
            }
            return $resultado;
        } else {
            return 0;
        }
    }
    
    public function retornar_SELECT(){
		return $this->_conexion->retornar_array();
	}
   
}  
?>