<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"]){
	$tarea_actual="NOTAS";
$sql="select * from integrantes where id_integrante='".$_SESSION["id_integrante"]."'";
$inicia_usuario=mysql_query($sql,$conexion);
$usuario=mysql_fetch_array($inicia_usuario);
?>
<html>
<head>
<title>..::NOTAS::..</title>
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
	<table align="center" width="500px" >
		<tr class="encabezado_tabla" >
			<td align="center" valign="top" width="200" >
				Examen
			</td>
			<td align="center" valign="top" width="70" >
				Fecha
			</td>
			<td align="center" valign="top" width="100" >
				Nota
			</td>
			<td align="center" valign="top" width="130" >
				Condicion
			</td>
		</tr>
<?php $sql= "select * from examenes,notas where examenes.id_examen=notas.id_examen 
		AND notas.id_integrante=".$_SESSION["id_integrante"]." 
			order by examenes.id_examen asc";
$res=mysql_query($sql,$conexion);
while ($asist=mysql_fetch_array($res)){
?>
		<tr class="registros_tabla" >
			<td align="center" valign="top" width="100" >
				<?php echo $asist["examen"]; ?>
			</td>
			<td align="center" valign="top" width="100" >
				<?php echo $asist["fecha"]; ?>
			</td>
			<td align="center" valign="top" width="100" >
				<?php echo $asist["nota"]; ?>
			</td>
			<td align="center" valign="top" width="150" >
				<?php echo $asist["condicion"]; ?>
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
