<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
$id_integrante = $_POST["id"];
if($id_integrante){
	$tarea_actual="HOME EDITAR DATOS";
$sql="select * from integrantes where id_integrante='".$id_integrante."'";
$inicia_usuario=mysql_query($sql,$conexion);
$usuario=mysql_fetch_array($inicia_usuario);
?>
<html>
<head>
<title>..::HOME::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
<script type="text/javascript" language="javascript" >
	function validar_datos(){
		var form=document.form;
		//Esta funcion no esta siendo utilizada
//******************************************************************************************
		if (form.integrante.value==0  || valida_cadena(form.integrante.value)==false ){
			document.getElementById("div_integrante").innerHTML="<font color='#ff0000'>El nombre del integrante no es  valido</font>";
			form.integrante.value="";
			form.integrante.focus();
			return false;
			}
		else {
			document.getElementById("div_integrante").innerHTML="";
			}
//******************************************************************************************
		if (form.usuario.value==0){
			document.getElementById("div_usuario").innerHTML="<font color='#ff0000'>Nombre de usuario no valido</font>";
			form.usuario.value="";
			form.usuario.focus();
			return false;
			}
		else {
			document.getElementById("div_abreviatura").innerHTML="";
			}
//******************************************************************************************
		if (form.cargo.value==0){
			document.getElementById("div_cargo").innerHTML="<font color='#ff0000'>El cargo no es valido</font>";
			form.cargo.value="";
			form.cargo.focus();
			return false;
			}
		else {
			document.getElementById("div_cargo").innerHTML="";
			}
//******************************************************************************************
		if (form.celular.value==0 || valida_numero(form.celular.value)==false){
			document.getElementById("div_celular").innerHTML="<font color='#ff0000'>Numero de celular no valido</font>";
			form.celular.value="";
			form.celular.focus();
			return false;
			}
		else {
			document.getElementById("div_celular").innerHTML="";
			}
//******************************************************************************************
		if (form.gmail.value==0 || valida_correo(form.gmail.value)==false){
			document.getElementById("div_gmail").innerHTML="<font color='#ff0000'>Direccion de correo no valido</font>";
			form.gmail.value="";
			form.gmail.focus();
			return false;
			}
		else {
			document.getElementById("div_gmail").innerHTML="";
			}
//******************************************************************************************
		if (form.e_mail.value==0 || valida_correo(form.e_mail.value)==false){
			document.getElementById("div_e_mail").innerHTML="<font color='#ff0000'>Direccion de correo no valido</font>";
			form.e_mail.value="";
			form.e_mail.focus();
			return false;
			}
		else {
			document.getElementById("div_e_mail").innerHTML="";
			}
//******************************************************************************************
		if (form.direccion.value==0){
			document.getElementById("div_direccion").innerHTML="<font color='#ff0000'>Direccion no valida</font>";
			form.direccion.value="";
			form.direccion.focus();
			return false;
			}
		else {
			document.getElementById("div_direccion").innerHTML="";
			}
//******************************************************************************************
		if (form.facultad.value==0){
			document.getElementById("div_facultad").innerHTML="<font color='#ff0000'>Facultad no valida</font>";
			form.facultad.value="";
			form.facultad.focus();
			return false;
			}
		else {
			document.getElementById("div_facultad").innerHTML="";
			}
//******************************************************************************************
		if (form.especialidad.value==0){
			document.getElementById("div_especialidad").innerHTML="<font color='#ff0000'>Especialidad no valida</font>";
			form.especialidad.value="";
			form.especialidad.focus();
			return false;
			}
		else {
			document.getElementById("div_especialidad").innerHTML="";
			}
//******************************************************************************************
			document.form.submit();
		}
</script>
</head>
<body style="background-color:#88A6DC" >
<div id="contenedor">
	<div id="cabecera_ob" >
		<img src="ima/initec_presentacion.jpg" height="100%" align="left">
		<img src="foto_integrantes/<?php echo $usuario["foto"];?>" height="70px" align="right">
		<a href="cambios.php"><img src="ima/salir.png"  title="Salir" height="70px" align="right"></a>
	</div>
	<div id="cuerpo_tr" >
		<div id="presentacion_tr" >
			<div id="titulo_tr" >
			<h1><?php echo $tarea_actual; ?></h1>
			</div>
			<div >
<!-- *************************************************************************************************** -->
<?php 
$sql="select * from integrantes where id_integrante=".$id_integrante." ";
$res=mysql_query($sql,$conexion);
if($reg=mysql_fetch_array($res)){
?>
	<form action="inicio_editar_cambiar_2.php" method="post" name="form" enctype="multipart/form-data" >
	<table width="550px" align="center">
		<tr >
			<td width="350" class="informacion_extra" >
				Integrante
			</td>
			<td width="50" class="informacion_extra" >
				Abreviatura
			</td>
			<td width="150" class="datos_extra" rowspan="6" >
			<img src="foto_integrantes/<?php echo $reg["foto"]; ?>" width="150px">
			<input type="file" name="foto" >
			</td>
		</tr>
		<tr>
			<td width="350" class="datos_extra" >
				<textarea cols="16" rows="1" name="integrante"><?php echo $reg["integrante"];?></textarea>
				<div id="div_integrante" ></div>
			</td>
			<td width="50" class="datos_extra" >
				<input type="text" name="abreviatura" readonly="readonly" value="<?php echo $reg["abreviatura"];?>" >
				<div id="div_abreviatura" ></div>
			</td>
		</tr>
		<tr>
			<td width="100" class="informacion_extra" >
				Celular
			</td>
			<td width="300" class="informacion_extra" >
				Cargo
			</td>
		</tr>
		<tr>
			<td width="100" class="datos_extra" >
				<input type="text" name="celular" value="<?php echo $reg["celular"];?>" >
				<div id="div_celular" ></div>
			</td>
			<td width="300" class="datos_extra" >
				<textarea cols="16" name="cargo"><?php echo $reg["cargo"];?></textarea>
				<div id="div_cargo" ></div>
			</td>
		</tr>
		<tr>
			<td width="400" class="informacion_extra" colspan="2" >
				Gmail
			</td>
		</tr>
		<tr>
			<td width="400" class="datos_extra" colspan="2" >
				<textarea cols="35" rows="1" name="gmail"><?php echo $reg["gmail"];?></textarea>
				<div id="div_gmail" ></div>				
			</td>
		</tr>
		<tr>
			<td width="400" class="informacion_extra" colspan="2">
				E-mail
			</td>
			<td width="150" class="informacion_extra" >
				Usuario
			</td>
		</tr>
		<tr>
			<td width="400" class="datos_extra" colspan="2">
				<textarea cols="35" rows="1" name="e_mail"><?php echo $reg["e_mail"];?></textarea>
				<div id="div_e_mail" ></div>
			</td>
			<td width="150" class="datos_extra" >
				<input type="text" name="usuario" value="<?php echo $reg["usuario"];?>" >
				<div id="div_usuario" ></div>
			</td>
		</tr>
		<tr>
			<td width="300" class="informacion_extra" >
				Direccion
			</td>
			<td width="100" class="informacion_extra" >
				Especialidad
			</td>
			<td width="150" class="informacion_extra" >
				Facultad
			</td>
		</tr>
		<tr>
			<td width="300" class="datos_extra">
				<textarea cols="16" rows="1" name="direccion"><?php echo $reg["direccion"];?></textarea>
				<div id="div_direccion" ></div>
			</td>
			<td width="100" class="datos_extra" >
				<input type="text" name="especialidad" value="<?php echo $reg["especialidad"];?>" >
				<div id="div_especialidad" ></div>
			</td>
			<td width="150" class="datos_extra" >
				<input type="text" name="facultad" value="<?php echo $reg["facultad"];?>" >
				<div id="div_facultad" ></div>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="3" >
				<input type="button" title="Cambiar" value="..::Cambiar::.." onClick="document.form.submit()" >
			</td>
		</tr>
	</table>
	<input type="hidden" name="id" value="<?php echo $id_integrante;?>">
	</form>
	<?php 
	}
	?>
<!-- *************************************************************************************************** -->
			</div>
		</div>	
	</div>
</div>
	<div id="pie" >
	Pagina programada por JIBF
	</div>
</body>
</html>
<?php
} else {
	echo "<script type='text/javascript' language='javascript' >
alert ('Usted no tiene permisos para entrar a esta pagina');
		history.back();
</script>";
}
?>

