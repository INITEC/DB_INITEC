<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
$tarea_actual="OBSERVADOR ASISTENCIAS";
?>
<html>
<head>
<title>..::OBSERVADOR ASISTENCIAS::..</title>
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
<!-- *************************************************************************************** -->
<?php 
$sql="select * from reuniones order by id_fecha desc";
$res=mysql_query($sql,$conexion);
?>
		<table align="center" width="650" >
		<tr>
			<td align="center" valign="top" width="450" colspan="6">
			<h1 style="color:#CDE8F3" >Lista de Reuniones</h1>
			</td>
			</tr>
				
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
<!-- *************************************************************************************** -->
	</div>
	</div>
	</div>
</div>
	<div id="pie" >
	Pagina programada por JIBF
	</div>


</body>
</html>