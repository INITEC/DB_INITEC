<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"]){
	$tarea_actual="AD AGREGAR";
$sql="select * from integrantes where id_integrante='".$_SESSION["id_integrante"]."'";
$inicia_usuario=mysql_query($sql,$conexion);
$usuario=mysql_fetch_array($inicia_usuario);
?>
<html>
<head>
<title>..::AD AGREGAR::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" language="javascript" src="js/funciones_ajax.js"></script>
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

<form action="AD_general_agregar_enviar.php" method="post" name="form" >

<table align="center" width="400" >
<tr>
<td valign="top" align="center" width="400" colspan="2"	>
<h3>Agregar Integrante</h3>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Integrante:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="integrante" >
<div id="div_integrante" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Abreviatura:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="abreviatura" >
<div id="div_abreviatura" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Cargo:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="cargo" >
<div id="div_cargo" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Celular:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="celular" >
<div id="div_celular" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Gmail:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="gmail" >
<div id="div_gmail" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
E-Mail:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="e_mail" >
<div id="div_e_mail" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Direccion:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="direccion" >
<div id="div_direccion" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Facultad:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="facultad" >
<div id="div_facultad" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Especialidad:
</td>
<td valign="top" align="left" width="200" >
<input type="text" name="especialidad" >
<div id="div_especialidad" ></div>
</td>
</tr>

<tr>
<td align="right" valign="top" width="200" >
Foto:
</td>
<td valign="top" align="left" width="200" >
<input type="file" name="foto" >
<div id="div_foto" ></div>
</td>
</tr>

<tr>
<td align="center" valign="top" width="400" colspan="2" >
<input type="button" title="volver" value="volver" onClick="history.back();" >
&nbsp;&nbsp; || &nbsp;&nbsp;
<input type="submit" title="Agregar Integrante" value="Agregar Integrante" >

</table>
</form>



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