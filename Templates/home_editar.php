<?php 
session_start();
$id_integrante = $_SESSION["id_integrante"];
if($id_integrante) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "HOME";	
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
		<script type="text/javascript" languaje="javascript" src="home/verificar_igual.js"></script>
	</head>
	<body>
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
			<div >
<!-- *************************************************************************************************** -->
<?php 
require_once ("conexion1.php");

$sql="select * from integrantes where id_integrante=".$_SESSION["id_integrante"]." ";
$res=mysql_query($sql,$conexion);
if($reg=mysql_fetch_array($res)){
?>
	<form action="home_editar_cambiar.php" method="post" name="form" enctype="multipart/form-data" >
	<table width="550px" align="center">
		<tr >
			<td width="350" class="informacion_extra" >
				Integrante
			</td>
			<td width="50" class="informacion_extra" >
				Abreviatura
			</td>
			<td width="150" class="datos_extra" rowspan="6" >
			<img src="../foto_integrantes/<?php echo $reg["foto"]; ?>" width="150px">
			<input type="file" name="foto" >
			</td>
		</tr>
		<tr>
			<td width="350" class="datos_extra" >
				<textarea cols="16" rows="1" name="integrante"><?php echo $reg["integrante"];?></textarea>
				<div id="div_integrante" ></div>
			</td>
			<td width="50" class="datos_extra" >
				<input type="text" name="abreviatura" readonly="readonly" value="<?php echo $reg["abreviatura"];?>" >
				<div id="div_abreviatura" ></div>
			</td>
		</tr>
		<tr>
			<td width="100" class="informacion_extra" >
				Celular
			</td>
			<td width="300" class="informacion_extra" >
				Cargo
			</td>
		</tr>
		<tr>
			<td width="100" class="datos_extra" >
				<input type="text" name="celular" value="<?php echo $reg["celular"];?>" >
				<div id="div_celular" ></div>
			</td>
			<td width="300" class="datos_extra" >
				<textarea cols="16" name="cargo"><?php echo $reg["cargo"];?></textarea>
				<div id="div_cargo" ></div>
			</td>
		</tr>
		<tr>
			<td width="400" class="informacion_extra" colspan="2" >
				Gmail
			</td>
		</tr>
		<tr>
			<td width="400" class="datos_extra" colspan="2" >
				<textarea cols="35" rows="1" name="gmail"><?php echo $reg["gmail"];?></textarea>
				<div id="div_gmail" ></div>				
			</td>
		</tr>
		<tr>
			<td width="400" class="informacion_extra" colspan="2">
				E-mail
			</td>
			<td width="150" class="informacion_extra" >
				Usuario
			</td>
		</tr>
		<tr>
			<td width="400" class="datos_extra" colspan="2">
				<textarea cols="35" rows="1" name="e_mail"><?php echo $reg["e_mail"];?></textarea>
				<div id="div_e_mail" ></div>
			</td>
			<td width="150" class="datos_extra" >
				<input type="text" name="usuario" value="<?php echo $reg["usuario"];?>" >
				<div id="div_usuario" ></div>
			</td>
		</tr>
		<tr>
			<td width="300" class="informacion_extra" >
				Direccion
			</td>
			<td width="100" class="informacion_extra" >
				Especialidad
			</td>
			<td width="150" class="informacion_extra" >
				Facultad
			</td>
		</tr>
		<tr>
			<td width="300" class="datos_extra">
				<textarea cols="16" rows="1" name="direccion"><?php echo $reg["direccion"];?></textarea>
				<div id="div_direccion" ></div>
			</td>
			<td width="100" class="datos_extra" >
				<input type="text" name="especialidad" value="<?php echo $reg["especialidad"];?>" >
				<div id="div_especialidad" ></div>
			</td>
			<td width="150" class="datos_extra" >
				<input type="text" name="facultad" value="<?php echo $reg["facultad"];?>" >
				<div id="div_facultad" ></div>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="3" >
				<input type="button" title="Cambiar" value="..::Cambiar::.." onClick="document.form.submit()" >
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


