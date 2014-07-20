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
		onclick="window.location='observador_integrantes.php'">
		</div>
		<div class="boton_menu" >
		<img id="asistencia" src="ima/asistencia.png" height="30px" width="100px" 
		onMouseMove="botones('asistencia','150','50')" onMouseOut="botones('asistencia','100','30')"
		onclick="window.location='observador_asistencias.php'">
		</div>
		<div class="boton_menu" >
		<img id="notas" src="ima/notas.png" height="30px" width="100px" 
		onMouseMove="botones('notas','150','50')" onMouseOut="botones('notas','100','30')"
		>
		</div>
	</div>
	<div >
<?php 
require_once ("conexion1.php");
$sql="select * from examenes order by id_examen desc";
$res=mysql_query($sql,$conexion);
?>
		<table width="700px" align="center" >
		<tr>
			<td valign="top" align="center" width="700" colspan="6" >
				<h1 style="color:#CDE8F3" >Lista de Examenes Tomados</h1>
			</td>
		</tr>
		<tr class="encabezado_tabla" >
			<td valign="top" align="center" width="300" >
				Examen
			</td>
			<td valign="top" align="center" width="150" >
				Fecha
			</td>
			<td valign="top" align="center" width="100" >
				En base a
			</td>
			<td valign="top" align="center" width="100" >
				Nota aprobatoria
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
			<td valign="top" align="center" width="300" >
				<?php 
				echo $reg["examen"];
				?>
			</td>
			<td valign="top" align="center" width="150" >
				<?php 
				echo $reg["fecha"];
				?>
			</td>
			<td valign="top" align="center" width="100" >
				<?php 
				echo $reg["n_maxima"];
				?>
			</td>
			<td valign="top" align="center" width="100" >
				<?php 
				echo $reg["n_aprobatoria"];
				?>
			</td>
			<td valign="top" align="center" width="25" >
				<img title="Ver mas" src="ima/desplazar_abajo.png"  width="25px"
				onclick="from('<?php echo $reg["id_examen"]; ?>','ver_mas_<?php echo $reg["id_examen"]; ?>','observador_notas_mostrar.php')">
			</td>
			<td valign="top" align="center" width="25" >
				<img title="Ocultar info" src="ima/desplazar_arriba.png" width="25px"
				onclick="document.getElementById('ver_mas_<?php echo $reg["id_examen"]; ?>').innerHTML=''">
			</td> 
		</tr>
		<tr>
			<td width="700" colspan="6" >
			<div id="ver_mas_<?php echo $reg["id_examen"]; ?>" >
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


