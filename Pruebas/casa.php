<?php 
session_start();
//$_SESSION["id_integrante"]
//$_SESSION["trabajo"]
//	$tarea_actual="HOME";

function encabezado ($tarea_actual,$id_integrante,$trabajo ) {
//inicio de la funcion encabezado
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($id_integrante){

$sql="select * from integrantes where id_integrante='".$id_integrante."'";
$inicia_usuario=mysql_query($sql,$conexion);
$usuario=mysql_fetch_array($inicia_usuario);
?>
<html>
<head>
<title>..::HOME::..</title>
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
?>		
		</div>
		<div id="presentacion_tr" >
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
<!-- *************************************************************************************************** -->
			</div>
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

// fin de la funcion encabezado
} 

encabezado ('HOME','2','admi');
?>

	<div id="pie" >
	Pagina programada por JIBF
	</div>
</body>
</html>
