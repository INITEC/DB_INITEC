<?php 
session_start();
//$_SESSION["id_integrante"]
//$_SESSION["trabajo"]
//	$tarea_actual="HOME";

function cabecera ($foto) {
	?>	
		<img src="ima/initec_presentacion.jpg" height="100%" align="left">
		<img src="foto_integrantes/<?php echo $foto;?>" height="70px" align="right">
		<a href="salir.php"><img src="ima/salir.png"  title="Salir" height="70px" align="right"></a>
	<?php
}

function menu ($trabajo,$conexion) {
$menu = retornar_menu($trabajo);
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
}

function presentacion_HOME($tarea_actual,$id_integrante) {
?>
<div id="titulo_tr" >
			<h1><?php echo $tarea_actual; ?></h1>
			</div>
<?php 
/****************************************************************************************************/
echo "<script type='text/javascript' languaje='javascript'>
		from('".$id_integrante."','identidad','observador_integrantes_mostrar.php');
		</script>"
/****************************************************************************************************/
?>
			<div >
<!-- *************************************************************************************************** -->
				<div>
					<table width="700px" align="center">
						<tr>
							<td width="350px" align="left" >
								<input type="button" title="Cambiar Contraseña" value="..::Cambiar Contraseña::.." onClick="window.location='inicio_contrasena.php'">
							</td>
							<td width="350px" align="right" >
								<input type="button" title="Editar Datos" value="..::Editar Datos::.." onClick="window.location='inicio_editar.php'">
							</td>
						</tr>
					</table> 
				</div>
				<!-- Este div (identidad) usa AJAX para mostrar informacion linea 47 -->
				<div id="identidad">
				</div>
				</div>
			
<!-- *************************************************************************************************** -->
<?php
}

require_once ("conexion1.php");
require_once ("verificar_usuario.php");
?>



<html>
<head>
<title>..::HOME::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
</head>
<body style="background-color:#88A6DC">

<?php
$id_integrante='1';
$tarea_actual='HOME';
$trabajo='usuario';

if($id_integrante){

	//	funcion de confirmar datos y cargar nuevos
?>
	<div id="contenedor">
		<div id="cabecera_ob" >	
			<?php
				cabecera('JB.jpg');
			?>
		</div>
		<div id="cuerpo_tr" >
			<div id="menu_tr" >
				<?php
					menu ($trabajo,$conexion);
				?>
			</div>		
			<div id="presentacion_tr" >
				<?php
					presentacion_HOME('HOME','1');
				?>
			</div>	
		</div>
	</div>
<?php	
} else {
	echo "<script type='text/javascript' language='javascript' >
alert ('Usted no tiene permisos para entrar a esta pagina');
		history.back();
</script>";
}
?>

	<div id="pie" >
	Pagina programada por JIBF
	</div>
</body>
</html>