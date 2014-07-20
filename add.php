<?php 
require_once("conexion1.php");
$sql="insert into integrantes values (
null, '".$_POST["integrante"]."', '".$_POST["abreviatura"]."',
'".$_POST["cargo"]."', '".$_POST["celular"]."', '".$_POST["gmail"]."', 
'".$_POST["e_mail"]."', '".$_POST["direccion"]."', '".$_POST["facultad"]."', 
'".$_POST["especialidad"]."', '".$_POST["abreviatura"].".jpg')";

$tipo=$_FILES["foto"]["type"];


if($tipo=="image/jpeg"){

$temp=$_FILES["foto"]["tmp_name"];

//Ahora podemos subir la imagen al servidor
copy($temp,"foto_integrantes/".$_POST["abreviatura"].".jpg");

$res=mysql_query($sql,$conexion);
echo "<script type=''>
		alert('El nuevo integrante fue ingresado correctamente');
		window.location='integrantes.php'
</script>";}
else {
	echo "<script type=''>
		alert('El nuevo integrante no pudo se ingresado debido a que la imagen que coloco no es JPG');
		history.back();
</script>";}	
	
?>