<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("conexion1.php");
	require_once ("verificar_usuario.php");
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "AD_PAGOS";	
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
<form action="AD_pagos_pagar.php" method="post" name="reun">
		<table align="center" width="750" >
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					<select name="id_integrante">
				<?php 
				$inte="select id_integrante,integrante,estado from integrantes where estado='activo' order by integrante asc";
				$res_inte=mysql_query($inte,$conexion);
				while($reg_inte=mysql_fetch_array($res_inte)){
				?>					
					<option value="<?php echo $reg_inte["id_integrante"];?>"><?php echo $reg_inte["integrante"];?></option>
				<?php } ?>
					</select>
				</td>
				
				<td valign="top" width="250" class="informacion_extra" >
					<select name="id_deuda">
				<?php 
				$deud="select * from deudas where id_temporada='".$_SESSION["temporada"]."' AND 
						id_cobrador='".$_SESSION["id_integrante"]."' order by id_deuda asc";
				$res_deud=mysql_query($deud,$conexion);
				while($reg_deud=mysql_fetch_array($res_deud)){
				?>					
					<option value="<?php echo $reg_deud["id_deuda"];?>"><?php echo $reg_deud["nombre_deuda"];?></option>
				<?php } ?>
					</select>
				</td>
				<td valign="top" width="200" class="informacion_extra" >
				<input type="text" name="pago" value="0" >
				</td>
				<td align="center" valign="top" width="100" class="informacion_extra">
					<input type="button" title="Pagar" value="..::Pagar::.." onClick="document.reun.submit()" >
				</td>
				<input type="hidden" name="tarea" value="<?php echo $tarea_actual; ?>" >
			</tr>
		</table>
		</form>
		<!-- ******************************************************************************************* -->
<?php 
$sql="select nombre_deuda,id_deuda,id_temporada,cantidad from deudas where id_temporada='".$_SESSION["temporada"]."' order by id_deuda asc";
$res=mysql_query($sql,$conexion);
?>
			<table align="center"  >			
			<tr class="encabezado_tabla" >
				<td align="center" valign="center" height="100" width="70" >
				Foto
				</td>
				<td align="center" valign="center" height="100" width="200">
				Integrante
				</td>
			<?php 
			while($reg=mysql_fetch_array($res)){
			?>
				<td align="center" valign="center" height="100" width="20" class="rotate">
				<?php echo $reg["nombre_deuda"];?>
				</td>
			<?php 
			}
			?>
				<td align="center" valign="center" height="100" width="20" class="rotate">
				Deuda Total
				</td>
			</tr>
			<!-- **************************************************************************** -->
			<tr class="encabezado_tabla" >
				<td align="center" valign="center" width="200" colspan="2">
				Cantidad de la Deuda
				</td>
			<?php
			$sql_2="select id_deuda,id_temporada,cantidad from deudas where id_temporada='".$_SESSION["temporada"]."' order by id_deuda asc";
			$res_2=mysql_query($sql_2,$conexion);
			$deuda_total=0;
			while($reg_2=mysql_fetch_array($res_2)){
			?>
				<td align="center" valign="center" width="20">
				<?php echo $reg_2["cantidad"];
				$deuda_total=$deuda_total + $reg_2["cantidad"];
				?>
				</td>
			<?php 
			}
			?>
				<td align="center" valign="center" width="20" >
				<?php echo $deuda_total;?>
				</td>
			</tr>
			<!-- ****************************************************************************** -->
<?php 
$int="select id_integrante,integrante,estado,foto from integrantes where estado='activo' order by integrante asc";
$res_int=mysql_query($int,$conexion);
while($reg_int=mysql_fetch_array($res_int)){
?>
			<tr class="registros_tabla" >
				<td>
					<img src="../foto_integrantes/<?php echo $reg_int["foto"];?>" width="50" heigth="50" border="0" >
				</td>
				<td>
					<?php echo $reg_int["integrante"];?>
				</td>
			<?php 
			$vis="select pagos.id_deuda,pagos.id_integrante,pagos.pago,pagos.condicion,deudas.id_deuda,deudas.id_temporada,deudas.cantidad from pagos,deudas 
					where pagos.id_integrante='".$reg_int["id_integrante"]."' AND deudas.id_deuda=pagos.id_deuda 
					AND deudas.id_temporada='".$_SESSION["temporada"]."' order by pagos.id_deuda asc ";
			$res_vis=mysql_query($vis,$conexion);
			$deuda_total=0;
			while($reg_vis=mysql_fetch_array($res_vis)){
			$color=color_deuda($reg_vis["condicion"]);
			?>
				<td align="center" valign="top" width="20" class="<?php echo $color?>">
				<?php echo $reg_vis["pago"];
				$deuda_total=$deuda_total + $reg_vis["cantidad"] - $reg_vis["pago"];
				?>
				</td>
			<?php 
			}
			?>
				<td align="center" valign="top" width="20" >
				<?php echo $deuda_total;
				?>
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
