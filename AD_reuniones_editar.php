<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"] and $_POST["tarea"]=="AD REUNIONES"){
	$tarea_actual="AD REUNIONES EDITAR";
$sql="select * from integrantes where id_integrante='".$_SESSION["id_integrante"]."'";
$inicia_usuario=mysql_query($sql,$conexion);
$usuario=mysql_fetch_array($inicia_usuario);
?>
<html>
<head>
<title>..::AD REUNIONES EDITAR::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
<script type="text/javascript" language="javascript" >
	function validar_datos(){
		var form=document.reun;
//******************************************************************************************
		if (form.fecha.value=="00"){
			document.getElementById("div_fecha").innerHTML="<font color='#ff0000'>Escriba una fecha</font>";
			form.fecha.value="";
			form.fecha.focus();
			return false;
			}
		else {
			document.getElementById("div_fecha").innerHTML="";
			}
//******************************************************************************************
		if (form.hora_inicio.value=="00:00:00"){
			document.getElementById("div_hora_inicio").innerHTML="<font color='#ff0000'>Hora no valida, ingrese a partir de 00:00:01</font>";
			form.hora_inicio.value="00:00:01";
			form.hora_inicio.focus();
			return false;
			}
		else {
			document.getElementById("div_hora_inicio").innerHTML="";
			}
//******************************************************************************************
		if (form.hora_fin.value=="00:00:00" ){
			document.getElementById("div_hora_fin").innerHTML="<font color='#ff0000'>Hora no valida, ingrese a partir de 00:00:01</font>";
			form.hora_fin.value="";
			form.hora_fin.focus();
			return false;
			}
		else {
			document.getElementById("div_hora_fin").innerHTML="";
			}
//******************************************************************************************
		if (form.lugar.value==0){
			document.getElementById("div_lugar").innerHTML="<font color='#ff0000'>Lugar no valido</font>";
			form.lugar.value="OFICINA INITEC - RESIDENCIA UNI";
			form.lugar.focus();
			return false;
			}
		else {
			document.getElementById("div_lugar").innerHTML="";
			}
//******************************************************************************************
		if (form.asunto.value==0){
			document.getElementById("div_asunto").innerHTML="<font color='#ff0000'>Coloque el asunto de la reunion</font>";
			form.asunto.value="OFICINA INITEC - RESIDENCIA UNI";
			form.asunto.focus();
			return false;
			}
		else {
			document.getElementById("div_asunto").innerHTML="";
			}
//******************************************************************************************
			document.reun.submit();
		}
	function limpiar(){
		document.reun.reset();
		document.reun.nom.focus();
		}
</script>
</head>
<body style="background-color:#88A6DC" onLoad="limpiar()" >
<div id="contenedor">
	<div id="cabecera_ob" >
		<img src="ima/initec_presentacion.jpg" height="100%" align="left">
		<img src="foto_integrantes/<?php echo $usuario["foto"];?>" height="70px" align="right">
		<a href="salir.php"><img src="ima/salir.png"  title="Salir" height="70px" align="right"></a>
	</div>
	<div id="cuerpo_tr" >
		<div id="menu_tr" >
<?php
$menu = retornar_menu($_SESSION["trabajo"]);
$res_menu=mysql_query($menu,$conexion);
		while ($reg_menu=mysql_fetch_array($res_menu)){
?>		
			<div class="boton_menu_tr" >
			<img id="<?php echo $reg_menu["tarea"]; ?>" src="ima/tareas/<?php echo $reg_menu["grafico"]; ?>"  width="190px" height="30px"
			onMouseMove="botones('<?php echo $reg_menu["tarea"]; ?>','200','40')" onMouseOut="botones('<?php echo $reg_menu["tarea"]; ?>','190','30')"
			<?php if($tarea_actual != $reg_menu["tarea"]){ ?>onclick="window.location='<?php echo $reg_menu["direccion"]; ?>'" <?php } ?>>
			</div>
<?php 
			}
?>		
		</div>
		<div id="presentacion_tr" >
			<div id="titulo_tr" >
			<h1><?php echo $tarea_actual; ?></h1>
			</div>
			<div id="identidad" >
<!-- *************************************************************************************************** -->
<?php 
$camb="select * from reuniones where id_fecha='".$_POST["id_fecha"]."'";
$res_camb=mysql_query($camb,$conexion);
if($reg_camb=mysql_fetch_array($res_camb)){
?>
		
		<form action="AD_reuniones_editar_cambiar.php" method="post" name="reun">
		<table align="center" width="400" >
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Dia de la semana:
				</td>
				<td valign="top" align="left" width="200" >
					<select name="dia_semana">
					<option <?php if($reg_camb["dia_semana"]=="Lunes"){echo "selected";}?> value="Lunes">Lunes</option>
					<option <?php if($reg_camb["dia_semana"]=="Martes"){echo "selected";}?> value="Martes">Martes</option>
					<option <?php if($reg_camb["dia_semana"]=="Miercoles"){echo "selected";}?> value="Miercoles">Miercoles</option>
					<option <?php if($reg_camb["dia_semana"]=="Jueves"){echo "selected";}?> value="Jueves">Jueves</option>
					<option <?php if($reg_camb["dia_semana"]=="Viernes"){echo "selected";}?> value="Viernes">Viernes</option>
					<option <?php if($reg_camb["dia_semana"]=="Sabado"){echo "selected";}?> value="Sabado">Sabado</option>
					<option <?php if($reg_camb["dia_semana"]=="Domingo"){echo "selected";}?> value="Domingo">Domingo</option>
					</select>
					<div id="div_dia_semana" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Fecha:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="fecha" value="<?php echo $reg_camb["fecha"];?>" >
					<div id="div_fecha" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Hora de inicio:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="hora_inicio" value="<?php echo $reg_camb["hora_inicio"];?>" >
					<div id="div_hora_inicio" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Hora de finalizacion:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="hora_fin" value="<?php echo $reg_camb["hora_final"];?>" >
					<div id="div_hora_fin" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Lugar:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="lugar" value="<?php echo $reg_camb["lugar"];?>" >
					<div id="div_lugar" ></div>
				</td>
			</tr>
				
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Asunto:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="asunto" value="<?php echo $reg_camb["asunto"];?>" >
					<div id="div_asunto" ></div>
				</td>
			</tr>
				<input type="hidden" name="tarea" value="<?php echo $_POST["tarea"]; ?>" >
				<input type="hidden" name="id_fecha" value="<?php echo $_POST["id_fecha"]; ?>" >
			<tr>
				<td align="center" valign="top" width="400" colspan="2" >
					<input type="button" title="Cambiar" value="Cambiar" onClick="validar_datos()" >
				</td>
			</tr>
		</table>
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

