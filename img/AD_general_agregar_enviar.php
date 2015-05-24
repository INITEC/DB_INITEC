<?php
session_start();
require_once("conexion1.php")
if($_SESSION["id_integrante"]){
	$tipo=$_FILES["foto"]["type"];

$sql="insert into integrantes values (
null, integrante='".$_POST["integrante"]."', abreviatura='".$_POST["abreviatura"]."',
cargo='".$_POST["cargo"]."', celular='".$_POST["celular"]."', gmail='".$_POST["gmail"]."', 
e_mail='".$_POST["e_mail"]."', direccion='".$_POST["direccion"]."', facultad='".$_POST["facultad"]."', 
especialidad='".$_POST["especialidad"]."', foto='".$_POST["abreviatura"].".jpg')";

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

}
?>