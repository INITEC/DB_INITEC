<html>
<head>
<title>..::Vista de Observador::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
</head>
<body style="background-color:#88A6DC">
<div id="contenedor">
	<div id="cabecera_ob" >
		<img src="ima/initec_presentacion.jpg" height="100%" align="left">
		<img src="ima/vista_de_observador.png" width="450px" height="100%" align="center">
		<img src="ima/initec_presentacion.jpg" height="100%" align="right">
	</div>
	<div id="opciones_ob" >
		<div class="boton_menu" >
		<img id="principal" src="ima/principal.png" height="30px" width="100px" 
		onMouseMove="botones('principal','150','50')" onMouseOut="botones('principal','100','30')"
		onclick="window.location='index.php'">
		</div>
		<div class="boton_menu" >
		<img id="integrantes" src="ima/integrantes.png" height="30px" width="100px" 
		onMouseMove="botones('integrantes','150','50')" onMouseOut="botones('integrantes','100','30')"
		>
		</div>
		<div class="boton_menu" >
		<img id="asistencia" src="ima/asistencia.png" height="30px" width="100px" 
		onMouseMove="botones('asistencia','150','50')" onMouseOut="botones('asistencia','100','30')"
		onclick="window.location='observador_asistencias.php'">
		</div>
		<div class="boton_menu" >
		<img id="notas" src="ima/notas.png" height="30px" width="100px" 
		onMouseMove="botones('notas','150','50')" onMouseOut="botones('notas','100','30')"
		onclick="window.location='observador_notas.php'">
		</div>
	</div>
	<div >
<?php 
require_once ("conexion1.php");
$sql="select * from integrantes order by integrante asc";
$res=mysql_query($sql,$conexion);
?>
		<table width="700px" align="center" >
		<tr>
			<td valign="top" align="center" width="700" colspan="6" >
				<h1 style="color:#CDE8F3" >Integrantes del INITEC</h1>
			</td>
		</tr>
		<tr class="encabezado_tabla" >
			<td valign="top" align="center" width="200" >
				Integrante
			</td>
			<td valign="top" align="center" width="100" >
				Celular
			</td>
			<td valign="top" align="center" width="300" >
				Gmail
			</td>
			<td valign="top" align="center" width="50" >
				Foto
			</td>
			<td valign="top" align="center" width="25" >
				&nbsp;
			</td>
			<td valign="top" align="center" width="25" >
				&nbsp;
			</td> 
		</tr>
<?php 
while ($reg=mysql_fetch_array($res)){
?>
		<tr class="registros_tabla" >
			<td valign="top" align="center" width="200" >
				<?php 
				echo $reg["integrante"];
				?>
			</td>
			<td valign="top" align="center" width="100" >
				<?php 
				echo $reg["celular"];
				?>
			</td>
			<td valign="top" align="center" width="300" >
				<?php 
				echo $reg["gmail"];
				?>
			</td>
			<td valign="top" align="center" width="50" >
				<img src="foto_integrantes/<?php echo $reg["foto"];?>" width="50" heigth="50" border="0" >
			</td>
			<td valign="top" align="center" width="25" >
				<img title="Ver mas" src="ima/desplazar_abajo.png"  width="25px"
				onclick="from('<?php echo $reg["id_integrante"]; ?>','ver_mas_<?php echo $reg["id_integrante"]; ?>','observador_integrantes_mostrar.php')">
			</td>
			<td valign="top" align="center" width="25" >
				<img title="Ocultar info" src="ima/desplazar_arriba.png" width="25px"
				onclick="document.getElementById('ver_mas_<?php echo $reg["id_integrante"]; ?>').innerHTML=''">
			</td> 
		</tr>
		<tr>
			<td width="700" colspan="6" >
			<div id="ver_mas_<?php echo $reg["id_integrante"]; ?>" >
			</div>	
			</td>
		</tr>
<?php 
}
?>
		</table>
	</div>
	<div id="pie" >
	Pagina programada por JIBF
	</div>
</div>

</body>
</html>