<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("conexion1.php");
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "AD_AMONESTACIONES";	
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
		<form action="AD_amonestaciones_enviar.php" method="post">
			<table width="550px" align="center" style="background-color:#FF0000">
				<tr>
					<td width="550px">
					Instituto de Innovaci&oacuten Tecnol&oacutegica
					</td>
				</tr>
				<tr>
					<td>
					Direci&oacuten de Talento Humano<br>
					</td>
				</tr>
				<tr>	
					<td>
					<b>Carta de Amonestaci&oacuten </b>
					</td>
				</tr>
				<tr>
<?php 
$int="select integrante,id_integrante,estado from integrantes where estado='activo' order by integrante asc ";
$res_int=mysql_query($int,$conexion);
	date_default_timezone_set('America/Los_Angeles');
	$dia=date(d);
	$mes=date(n);
	$ano=date(Y);
?>
					<td align="right">
					UNI - <input type="text" name="fecha_emision" value="<?php echo "$ano-$mes-$dia";?>">
					</td>
				</tr>
				<tr>
					<td align="left">
					<select name="id_integrante"> <?php 
						while($reg_int=mysql_fetch_array($res_int)){			
						?>			
						<option value="<?php echo $reg_int["id_integrante"];?>"><?php echo $reg_int["integrante"];?></option>
						<?php 
						}
						?>
						</select> integrante del INITEC
					</td>
				</tr>
				<tr>
					<td width="550px" align="justify" >
					El Directorio de Talento Humano, en ejercicio de sus facultades de direcci&oacuten, a decidido amonestarle por escrito en virtud de los siguientes hechos:
					</td>
				</tr>
				<tr>
					<td>
					<textarea cols="65" rows="2" name="motivo"></textarea><br>
					</td>
				</tr>
				<tr>
					<td width="550" align="justify">
					Estos hechos constituyen para el INITEC una falta <select name="tipo" ><option value="leve">leve</option>
																				<option value="grave">grave</option></select>
					de conformidad con lo dispuesto en el articulo <input type="text" name="articulo" > del cap&iacutetulo <input type="text" name="capitulo" > del vigente estatuto y en su virtud de Director decide:
					</td>
				</tr>
				<tr>
					<td width="550" align="justify">
					Amonestarle por este comportamiento, y en el caso de acumular seis amonestaciones leves o dos graves, se proceder&aacute a separarlo de la organizaci&oacuten conforme lo estipula el Estatuto.
					</td>
				</tr>
				<tr>
					<td>
					Sin otro particular que manifestarle, se despide atentamente.
					</td>
				</tr>
				<tr>
					<td>
					<b>Directorio de Talento Humano</b>
					</td>
				</tr>
				<tr>
				<tr>
					<td>
					Fecha de la falta: <input type="text" name="fecha_falta" value="<?php echo "$ano-$mes-$dia";?>" >
					</td>
				</tr>
				<tr>
					<td width="550" align="center">
					<input type="submit" value="..::enviar::.." title="enviar">
					<input type="hidden" value="<?php echo $tarea_actual;?>" name="tarea">
					</td>
				</tr>
			</table>
			</form>	
<hr>	
<!-- *************************************************************************************************** -->
			<table align="center" width="650px" >
				<tr class="encabezado_tabla" >
					<td align="center" valign="top" width="150" >
						Remitente
					</td>
					<td align="center" valign="top" width="150" >
						Amonestado
					</td>
					<td align="center" valign="top" width="100" >
						Fecha Emision
					</td>
					<td align="center" valign="top" width="100" >
						Fecha Falta
					</td>
					<td align="center" valign="top" width="100" >
						Tipo
					</td>
					<td valign="top" align="center" width="25" >
						&nbsp;
					</td>
					<td valign="top" align="center" width="25" >
						&nbsp;
					</td> 
				</tr>
		<?php $sql= "select * from amonestaciones,integrantes where amonestaciones.receptor=integrantes.id_integrante 
					order by id_amonestacion desc";
			$res=mysql_query($sql,$conexion);
		while ($asist=mysql_fetch_array($res)){
			$add="select id_integrante,integrante from integrantes where id_integrante='".$asist["remitente"]."' ";
			$res_add=mysql_query($add,$conexion);
			if($reg_add=mysql_fetch_array($res_add)){
		?>
				<tr class="registros_tabla" >
					<td align="center" valign="top" width="150" >
						<?php echo $reg_add["integrante"]; ?>
					</td>
					<td align="center" valign="top" width="150" >
						<?php echo $asist["integrante"]; ?>
					</td>
					<td align="center" valign="top" width="100" >
						<?php echo $asist["fecha_emision"]; ?>
					</td>
					<td align="center" valign="top" width="100" >
						<?php echo $asist["fecha_falta"]; ?>
					</td>
					<td align="center" valign="top" width="100" >
						<?php echo $asist["tipo"]; ?>
					</td>
					<td valign="top" align="center" width="25" >
						<img title="Ver mas" src="../Imagenes/desplazar_abajo.png"  width="25px"
						onclick="from('<?php echo $asist["id_amonestacion"]; ?>','ver_mas_<?php echo $asist["id_amonestacion"]; ?>','usuario_amonestaciones_notificacion.php')">
					</td>
					<td valign="top" align="center" width="25" >
						<img title="Ocultar info" src="../Imagenes/desplazar_arriba.png" width="25px"
						onclick="document.getElementById('ver_mas_<?php echo $asist["id_amonestacion"]; ?>').innerHTML=''">
					</td>
				</tr>
				<tr>
					<td width="600" colspan="6" >
					<div id="ver_mas_<?php echo $asist["id_amonestacion"]; ?>" >
					</div>	
					</td>
				</tr>
		<?php
				}	
		}
		?>
			</table>
<!-- *************************************************************************************************** -->			
			</div>		</div>	
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
