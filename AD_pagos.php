<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"]){
	$tarea_actual="AD PAGOS";
$sql="select * from integrantes where id_integrante='".$_SESSION["id_integrante"]."'";
$inicia_usuario=mysql_query($sql,$conexion);
$usuario=mysql_fetch_array($inicia_usuario);
?>
<html>
<head>
<title>..::AD PAGOS::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
</head>
<body style="background-color:#88A6DC">
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
				$deud="select id_deuda,nombre_deuda,id_temporada,cobrador from deudas where id_temporada='".$_SESSION["temporada"]."' AND 
						cobrador='".$_SESSION["id_integrante"]."' order by id_deuda asc";
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
					<img src="foto_integrantes/<?php echo $reg_int["foto"];?>" width="50" heigth="50" border="0" >
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

