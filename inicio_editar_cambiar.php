<?php 
session_start();
require_once ("conexion1.php");
if($_SESSION["id_integrante"]){
	$tipo=$_FILES["foto"]["type"];
	
	if($tipo != "" ){
	
		$sql="update integrantes set 
		integrante='".$_POST["integrante"]."', abreviatura='".$_POST["abreviatura"]."',
		cargo='".$_POST["cargo"]."', celular='".$_POST["celular"]."', gmail='".$_POST["gmail"]."', 
		e_mail='".$_POST["e_mail"]."', direccion='".$_POST["direccion"]."', facultad='".$_POST["facultad"]."', 
		especialidad='".$_POST["especialidad"]."', foto='".$_POST["abreviatura"].".jpg'
		where id_integrante=".$_SESSION["id_integrante"]."";
		
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
		
		$sql="update integrantes set
		integrante='".$_POST["integrante"]."', abreviatura='".$_POST["abreviatura"]."',
		cargo='".$_POST["cargo"]."', celular='".$_POST["celular"]."', gmail='".$_POST["gmail"]."',
		e_mail='".$_POST["e_mail"]."', direccion='".$_POST["direccion"]."', facultad='".$_POST["facultad"]."',
		especialidad='".$_POST["especialidad"]."'
		where id_integrante=".$_SESSION["id_integrante"]."";	
			
		$res=mysql_query($sql,$conexion);
		echo "<script type=''>
				alert('Los datos del integrante fueron modificados con exito');
				window.location='inicio.php'
		</script>";	
	}
}
?>
