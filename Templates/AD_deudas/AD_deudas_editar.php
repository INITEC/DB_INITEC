<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("conexion1.php");
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "HORAS_TRABAJO";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_integrante);
	$id_trabajo = $integrante->retornar_id_trabajo();
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {
		$trabajos = new trabajos_int();
		$tareas = new tareas_int();
/* ..................................................................................................................... */
?>
<html>
	<head>
	<title>..::<?php echo $tarea_actual; ?>::..</title>
	<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
	<script type="text/javascript" language="javascript" src="../JavaScript/validacion_input_1.js" ></script>
	<script type="text/javascript" languaje="javascript" src="../JavaScript/funciones_ajax.js"></script>
	</head>
	<body style="background-color:#88A6DC">
	<div id="contenedor_tr">
		<div id="cabecera_tr">
				<?php include_once("../Include/cabecera_tarea.php");?>
		</div>
		<div id="cuerpo_tr">
				<div id="menu_izquierda_tr">
					<?php include_once("../Include/menu_obligaciones.php");?>
				</div>
		<div id="presentacion_tr" >
			<div id="titulo_tr" >
			<h1><?php echo $tarea_actual; ?></h1>
			</div>
			<br>
			<div id="identidad" >
<!-- *************************************************************************************************** -->
<?php 
$camb="select * from deudas where id_deuda='".$_POST["id_deuda"]."'";
$res_camb=mysql_query($camb,$conexion);
if($reg_camb=mysql_fetch_array($res_camb)){
?>
		
		<form action="AD_deudas_editar_cambiar.php" method="post" name="reun">
		<table align="center" width="400" >
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Nombre de la deuda:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="nombre_deuda" value="<?php echo $reg_camb["nombre_deuda"]; ?>" >
					<div id="div_nombre_deuda" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Ultimo dia de pago:
				</td>
				<td valign="top" align="left" width="200" >
					
					<input type="text" name="fecha_final" value="<?php echo $reg_camb["fecha_final"];?>" >
					<div id="div_fecha_final" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Cantidad de Pago(Soles):
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="cantidad" value="<?php echo $reg_camb["cantidad"];?>" >
					<div id="div_cantidad" ></div>
				</td>
			</tr>
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Encargado de Cobrar:
				</td>
				<td valign="top" width="200" class="informacion_extra" >
						<select name="cobrador">
					<?php 
					$inte="select id_integrante,integrante,estado from integrantes where estado='activo' order by integrante asc";
					$res_inte=mysql_query($inte,$conexion);
					while($reg_inte=mysql_fetch_array($res_inte)){
					?>					
						<option  <?php if($reg_camb["cobrador"]==$reg_inte["id_integrante"]){echo "selected";}?>  value="<?php echo $reg_inte["id_integrante"];?>"><?php echo $reg_inte["integrante"];?></option>
					<?php } ?>
						</select>
				</td>
			</tr>
               	<input type="hidden" name="tarea" value="<?php echo $_POST["tarea"]; ?>" >
				<input type="hidden" name="id_deuda" value="<?php echo $_POST["id_deuda"]; ?>" >
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
		<div id="pie_pagina_tr">
			<?php include_once("../Include/pie_pagina.php");?>
		</div>
	</body>
</html>

<?php 
/* ................................................................................................................. */
			}
	else {
			include_once ("../Include/no_tarea.php");
			}	
		}
else {
		include_once ("../Include/no_acceso.php");
		}

?>
