<?php
class conexion {
	
	private $_conexion;
	private $_base_datos;
	private $_sql;
	private $_result;	
	
	public function __construct () {
        $this->_conexion = mysql_connect("localhost", "root", "jibf123");
		$this->_base_datos = mysql_select_db("redwe_12350066_initec");
		
        /*
		$this->_conexion = mysql_connect("sql307.redwebmaster.com.ar","redwe_12350066","jibf123");
		$this->_base_datos = mysql_select_db("redwe_12350066_initec");
		*/
		
	} 
	public function ejecutar_sentencia ($sql) {
		$this->_sql = $sql;
		return ($this->_result = mysql_query($this->_sql , $this->_conexion));
	}
	public function ejecutar_ultima_sentencia () {
		return ($this->_result = mysql_query($this->_sql , $this->_conexion));
	}
	public function retornar_array() {
		return mysql_fetch_array($this->_result);
	}
	public function tam_respuesta() {
		return mysql_num_rows($this->_result);
	}
}
?>

