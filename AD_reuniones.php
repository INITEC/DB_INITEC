<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"]){
	$tarea_actual="AD REUNIONES";
$sql="select * from integrantes where id_integrante='".$_SESSION["id_integrante"]."'";
$inicia_usuario=mysql_query($sql,$conexion);
$usuario=mysql_fetch_array($inicia_usuario);
?>
<html>
<head>
<title>..::AD REUNIONES::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
<script type="text/javascript" language="javascript" >
	function validar_datos(){
		var form=document.reun;
//******************************************************************************************
		if (form.dia_semana.value == "0" ){
			document.getElementById("div_dia_semana").innerHTML="<font color='#ff0000'>Eliga un dia de la semana</font>";
			form.dia_semana.value="0";
			form.dia_semana.focus();
			return false;
			}
		else {
			document.getElementById("div_dia_semana").innerHTML="";
			}
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
		<form action="AD_reuniones_crear.php" method="post" name="reun">
		<table align="center" width="400" >
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Dia de la semana:
				</td>
				<td valign="top" align="left" width="200" >
					<select name="dia_semana">
					<option value="0">Selecione un dia</option>
					<option value="Lunes">Lunes</option>
					<option value="Martes">Martes</option>
					<option value="Miercoles">Miercoles</option>
					<option value="Jueves">Jueves</option>
					<option value="Viernes">Viernes</option>
					<option value="Sabado">Sabado</option>
					<option value="Domingo">Domingo</option>
					</select>
					<div id="div_dia_semana" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Fecha:
				</td>
				<td valign="top" align="left" width="200" >
					<?php 
					date_default_timezone_set('America/Los_Angeles');
					$dia=date(d);
					$mes=date(n);
					$ano=date(Y);
					?>
					<input type="text" name="fecha" value="<?php echo "$ano-$mes-$dia";?>" >
					<div id="div_fecha" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Hora de inicio:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="hora_inicio" value="00:00:00" >
					<div id="div_hora_inicio" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Hora de finalizacion:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="hora_fin" value="00:00:00" >
					<div id="div_hora_fin" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Lugar:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="lugar" value="OFICINA INITEC - RESIDENCIA UNI" >
					<div id="div_lugar" ></div>
				</td>
			</tr>
				
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Asunto:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="asunto" value="REUNION DE INFORMACION Y COORDINACION" >
					<div id="div_asunto" ></div>
				</td>
			</tr>
				<input type="hidden" name="tarea" value="<?php echo $tarea_actual; ?>" >
			<tr>
				<td align="center" valign="top" width="400" colspan="2" >
					<input type="button" title="Crear" value="..::Crear::.." onClick="validar_datos()" >
				</td>
			</tr>
		</table>
		</form>
<!-- *************************************************************************************************** -->			
		<hr>			
<?php 
$sql="select * from reuniones order by id_fecha desc";
$res=mysql_query($sql,$conexion);
?>
		<table align="center" width="650" >				
			<tr class="encabezado_tabla" >
				<td align="center" valign="top" width="150" >
				Dia
				</td>
				<td align="center" valign="top" width="150" >
				Fecha
				</td>
				<td align="center" valign="top" width="150" >
				Hora inicio
				</td>
				<td align="center" valign="top" width="150" >
				Hora final
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
				<td valign="top" align="center" width="25" >
					&nbsp;
				</td>
			</tr>
<?php 
while($reg=mysql_fetch_array($res)){
?>
			<tr class="registros_tabla" >
				<td align="center" valign="top" width="150" >
					<?php echo $reg["dia_semana"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["fecha"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["hora_inicio"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["hora_final"]; ?>
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ver mas" src="ima/desplazar_abajo.png"  width="25px"
					onclick="from('<?php echo $reg["id_fecha"]; ?>','ver_mas_<?php echo $reg["id_fecha"]; ?>','observador_asistencias_mostrar.php')">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ocultar info" src="ima/desplazar_arriba.png" width="25px"
					onclick="document.getElementById('ver_mas_<?php echo $reg["id_fecha"]; ?>').innerHTML=''">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Editar" src="ima/editar.png" width="20px"
					onClick="document.form_<?php echo $reg["id_fecha"];?>.submit()">
					<!-- ************************************************************ -->
					<form action="AD_reuniones_editar.php" method="post" name="form_<?php echo $reg["id_fecha"];?>" >
					<input type="hidden" name="id_fecha" value="<?php echo $reg["id_fecha"];?>" >
					<input type="hidden" name="tarea" value="<?php echo $tarea_actual; ?>" >
					</form>
					<!-- ************************************************************ -->
				</td>
			</tr>
			<tr>
				<td width="450" colspan="6" >
				<div id="ver_mas_<?php echo $reg["id_fecha"]; ?>" >
				</div>	
				</td>
			</tr>
		
<?php 
}
?>
		</table>
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

