<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("conexion1.php");
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	require_once ("../require/mes_text_func.php");
	
	$tarea_actual = "AD_DEUDAS";	
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
		<form action="AD_deudas_crear.php" method="post" name="reun">
		<table align="center" width="400" >
			        <?php
					date_default_timezone_set('America/Los_Angeles');
					$dia=date(d);
					$mes=date(n);
					$ano=date(Y);
					?>
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Nombre de la deuda:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="nombre_deuda" value="<?php echo mes_text($mes); ?>" >
					<div id="div_nombre_deuda" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Ultimo dia de pago:
				</td>
				<td valign="top" align="left" width="200" >
					
					<input type="text" name="fecha_final" value="<?php echo "$ano-$mes-$dia";?>" >
					<div id="div_fecha_final" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Cantidad de Pago(Soles):
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="cantidad" value="10" >
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
						<option value="<?php echo $reg_inte["id_integrante"];?>"><?php echo $reg_inte["integrante"];?></option>
					<?php } ?>
						</select>
				</td>
			</tr>
			
				<input type="hidden" name="fecha_creada" value="<?php echo "$ano-$mes-$dia"; ?>" >
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
$sql="select * from deudas order by id_deuda desc";
$res=mysql_query($sql,$conexion);
?>
		<table align="center" width="650" >				
			<tr class="encabezado_tabla" >
				<td align="center" valign="top" width="150" >
				Nombre de la Deuda
				</td>
				<td align="center" valign="top" width="150" >
				Fecha creada
				</td>
				<td align="center" valign="top" width="150" >
				Fecha limite
				</td>
				<td align="center" valign="top" width="150" >
				Cantidad
				</td>
				<td valign="top" align="center" width="25" >&nbsp;
					
				</td>
				<td valign="top" align="center" width="25" >&nbsp;
					
				</td>
				<td valign="top" align="center" width="25" >&nbsp;
					
				</td>
			</tr>
<?php 
while($reg=mysql_fetch_array($res)){
?>
			<tr class="registros_tabla" >
				<td align="center" valign="top" width="150" >
					<?php echo $reg["nombre_deuda"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["fecha_creada"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["fecha_final"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["cantidad"]; ?>
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ver mas" src="../Imagenes/desplazar_abajo.png"  width="25px"
					onclick="from('<?php echo $reg["id_deuda"]; ?>','ver_mas_<?php echo $reg["id_deuda"]; ?>','observador_deudas_mostrar.php')">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ocultar info" src="../Imagenes/desplazar_arriba.png" width="25px"
					onclick="document.getElementById('ver_mas_<?php echo $reg["id_deuda"]; ?>').innerHTML=''">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Editar" src="../Imagenes/editar.png" width="20px"
					onClick="document.form_<?php echo $reg["id_deuda"];?>.submit()">
					<!-- ************************************************************ -->
					<form action="AD_deudas_editar.php" method="post" name="form_<?php echo $reg["id_deuda"];?>" >
					<input type="hidden" name="id_deuda" value="<?php echo $reg["id_deuda"];?>" >
					<input type="hidden" name="tarea" value="<?php echo $tarea_actual; ?>" >
					</form>
					<!-- ************************************************************ -->
				</td>
			</tr>
			<tr>
				<td width="450" colspan="6" >
				<div id="ver_mas_<?php echo $reg["id_deuda"]; ?>" >
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
