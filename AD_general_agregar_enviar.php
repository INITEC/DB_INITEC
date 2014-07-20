<?php 
session_start();
require_once ("conexion1.php");
if($_SESSION["id_integrante"]){
	$tipo=$_FILES["foto"]["type"];
	
	if($tipo != "" ){
	
$sql="insert into integrantes (id_integrante , integrante , abreviatura , cargo , celular , gmail , e_mail ,
 direccion , facultad , especialidad , foto ) values (null, '".$_POST["integrante"]."', '".$_POST["abreviatura"]."',
'".$_POST["cargo"]."', '".$_POST["celular"]."', '".$_POST["gmail"]."', '".$_POST["e_mail"]."', '".$_POST["direccion"]."', 
'".$_POST["facultad"]."' , '".$_POST["especialidad"]."', '".$_POST["abreviatura"].".jpg')"; 
		
		if($tipo=="image/jpeg"){
		
			$temp=$_FILES["foto"]["tmp_name"];
		
			//Ahora podemos subir la imagen al servidor
			copy($temp,"foto_integrantes/".$_POST["abreviatura"].".jpg");
		
			$res=mysql_query($sql,$conexion);
			echo "<script type=''>
				alert('Los datos del integrante fueron modificados con exito');
				window.location='inicio.php'
			</script>";}
		else {
				echo "<script type=''>
				alert('Los datos no pudieron ser modificados debido a que la imagen que coloco no es JPG');
				history.back();
			</script>";}
	} 
	
	//***************************************************************************************************
	else {
		
$sql="insert into integrantes (id_integrante , integrante , abreviatura , cargo , celular , gmail , e_mail ,
 direccion , facultad , especialidad , foto ) values (null, '".$_POST["integrante"]."', '".$_POST["abreviatura"]."',
'".$_POST["cargo"]."', '".$_POST["celular"]."', '".$_POST["gmail"]."', '".$_POST["e_mail"]."', '".$_POST["direccion"]."', 
'".$_POST["facultad"]."' , '".$_POST["especialidad"]."', '".$_POST["abreviatura"].".jpg')";
			
		$res=mysql_query($sql,$conexion);
		echo "<script type=''>
				alert('Los datos del integrante fueron modificados con exito');
				window.location='inicio.php'
		</script>";	
	}
}
?>