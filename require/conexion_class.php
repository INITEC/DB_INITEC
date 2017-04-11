<?php
class conexion {
	
	private $_conexion;
	private $_base_datos;
	private $_sql;
	private $_result;	
	
	public function __construct () {
        
	//Localhost
    /*	
	$this->_conexion = mysql_connect("localhost", "root", "jibf123");
	$this->_base_datos = mysql_select_db("redwe_12350066_initec");
    */	
	//Digital Ocean
    
    $this->_conexion = mysqli_connect("localhost", "root","123","redwe_12350066_initec");

	
	// Server Redwebmaster
	/*
	$this->_conexion = mysql_connect("sql307.redwebmaster.com.ar","redwe_12350066","jibf123");
	$this->_base_datos = mysql_select_db("redwe_12350066_initec");
	*/
	
	// Hosting Godaddy
    /*    
	$this->_conexion = mysql_connect("localhost", "JIBF", "jibf123") or die('No pudo conectarse: ' . mysql_error());
	$this->_base_datos = mysql_select_db("redwe_12350066_initec");
    */  
        
	} 
	public function ejecutar_sentencia ($sql) {
		$this->_sql = $sql;
		return ($this->_result = mysqli_query($this->_conexion , $this->_sql));
	}
	public function ejecutar_ultima_sentencia () {
		return ($this->_result = mysqli_query($this->_conexion, $this->_sql));
	}
	public function retornar_array() {
		return mysqli_fetch_array($this->_result);
	}
	public function tam_respuesta() {
		return mysqli_num_rows($this->_result);
	}
}
?>

