<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
//*********Temporada*******************
$tempo="select id_temporada from temporadas order by id_temporada desc limit 1";
$res_tempo=mysql_query($tempo,$conexion);
$reg_tempo=mysql_fetch_array($res_tempo);
$_SESSION["temporada"]=$reg_tempo["id_temporada"];
//**************************************
$tarea_actual="OBSERVADOR INASISTENCIAS";
?>
<html>
<head>
<title>..::OBSERVADOR INASISTENCIAS::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
</head>
<body style="background-color:#88A6DC">
<div id="contenedor">
	<div id="cabecera_ob" >
	<?php 
	if ($_SESSION["id_integrante"]){
		$sql="select * from integrantes where id_integrante='".$_SESSION["id_integrante"]."'";
		$inicia_usuario=mysql_query($sql,$conexion);
		$usuario=mysql_fetch_array($inicia_usuario);
	?>
		<img src="ima/initec_presentacion.jpg" height="100%" align="left">
		<img src="foto_integrantes/<?php echo $usuario["foto"];?>" height="70px" align="right">
		<a href="salir.php"><img src="ima/salir.png"  title="Salir" height="70px" align="right"></a>
	<?php 
	} else {
	?>
		<img src="ima/initec_presentacion.jpg" height="100%" align="left">
		<img src="ima/vista_de_observador.png" width="450px" height="100%" align="center">
		<img src="ima/initec_presentacion.jpg" height="100%" align="right">
	<?php 
	}
	?>
	</div>
	<div id="cuerpo_tr">
		<div id="menu_tr" >
			<?php 
			if (!($_SESSION["id_integrante"])){
			?>
			<div class="boton_menu_tr" >
			<img id="principal" src="ima/tareas/pagina_principal.png"  width="190px" height="30px"
			onMouseMove="botones('principal','200','40')" onMouseOut="botones('principal','190','30')"
			onclick="window.location='index.php'">
			</div>
			<?php
				}
			if($_SESSION["id_integrante"]){$menu = retornar_menu($_SESSION["trabajo"]);}
			else {$menu = retornar_menu("observador");}
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
		<div id="presentacion_tr">
			<div id="titulo_tr" >
				<h1><?php echo $tarea_actual; ?></h1>
			</div>
			<div >
<!-- **************************************************************************************** -->
		<?php 
		$sql="select * from integrantes where estado='activo' order by integrante asc";
		$res=mysql_query($sql,$conexion);
		?>
				<table width="900px" align="center" >
					<tr>
						<td valign="top" align="center" width="700" colspan="6" >
							<h1 style="color:#CDE8F3" >Integrantes del INITEC</h1>
						</td>
					</tr>
					<tr class="encabezado_tabla" >
						<td valign="top" align="center" width="80" >
							Foto
						</td>
						<td valign="top" align="center" width="250" >
							Integrante
						</td>
						<td valign="top" align="center" width="400" >
							Estado
						</td>
					</tr>
		<?php 
		while ($reg=mysql_fetch_array($res)){
				$faltas="select count(*) as cuantos from asistencias,reuniones where  asistencias.id_fecha=reuniones.id_fecha 
				AND asistencias.id_integrante='".$reg["id_integrante"]."' AND reuniones.id_temporada='".$_SESSION["temporada"]."' 
				AND asistencias.asistencia='No Asistio' ";
				$res_faltas=mysql_query($faltas,$conexion);
				$reg_faltas=mysql_fetch_array($res_faltas);
				$faltas_total=$reg_faltas["cuantos"];
				if($faltas_total > 6){$faltas_total = 6;}
				$id_integrante = $reg["id_integrante"];
			?>
					<tr class="registros_tabla" >
						<td valign="top" align="center" width="50" >
							<img src="foto_integrantes/<?php echo $reg["foto"];?>" width="80" height="60" border="0" >
						</td>
						<td valign="top" align="center" width="250" >
							<?php 
							echo $reg["integrante"];
							?>
						</td>
						<td valign="top" align="center" width="400" >
							
								<div>
									<?php 
									$amon="select count(*) as cuantos from amonestaciones where receptor='".$id_integrante."' AND tipo='leve' AND id_temporada='".$_SESSION["temporada"]."' ";
									$res_amon=mysql_query($amon,$conexion);
									$reg_amon=mysql_fetch_array($res_amon);
									$amon_leves=$reg_amon["cuantos"];
									$amon="select count(*) as cuantos from amonestaciones where receptor='".$id_integrante."' AND tipo='grave' AND id_temporada='".$_SESSION["temporada"]."' ";
									$res_amon=mysql_query($amon,$conexion);
									$reg_amon=mysql_fetch_array($res_amon);
									$amon_graves=$reg_amon["cuantos"];
									$amon_total=$amon_leves + ($amon_graves * 2);
									if($amon_total > 6){$amon_total = 6;}
									?>
									<img src="ima/barra_<?php echo $amon_total;?>.png" width="400" height="15">
									<br>
									Usted tiene <?php echo $amon_leves;?> falta(s) leve(s) y <?php echo $amon_graves;?> falta(s) grave(s)	
									
								</div>
								<div>
	
									<?php 
									$faltas="select count(*) as cuantos from asistencias,reuniones where  asistencias.id_fecha=reuniones.id_fecha AND asistencias.id_integrante='".$id_integrante."' AND reuniones.id_temporada='".$_SESSION["temporada"]."' AND asistencias.asistencia='No Asistio' ";
									$res_faltas=mysql_query($faltas,$conexion);
									$reg_faltas=mysql_fetch_array($res_faltas);
									$faltas_total=$reg_faltas["cuantos"];
									if($faltas_total > 8){$faltas_total = 8;}
									?>
									<img src="ima/barra_<?php echo $faltas_total;?>.png" width="400" height="15" >
									<br>
									Usted tiene <?php echo $faltas_total;?> inasistencia(s)	
						
								</div>
							
						</td>
					</tr>
		<?php 
		}
		?>
				</table>
<!-- **************************************************************************************** -->
			</div>
		</div>
	</div>
</div>
	<div id="pie" >
	Pagina programada por JIBF
	</div>


</body>
</html>
