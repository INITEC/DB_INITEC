<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"]){
	$tarea_actual="HOME CAMBIAR CONTRASEÑA";
$sql="select * from integrantes where id_integrante='".$_SESSION["id_integrante"]."'";
$inicia_usuario=mysql_query($sql,$conexion);
$usuario=mysql_fetch_array($inicia_usuario);
?>
<html>
<head>
<title>..::HOME::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
<script type="text/javascript" language="javascript" >
	function verificar_igual(){
		var form=document.form;
//******************************************************************************************
		if (form.clave1.value==form.clave2.value && form.clave1.value!=0 && form.clave2.value!=0){
			document.form.submit();
			}
		else {
			document.getElementById("div_clave").innerHTML="<font color='#ff0000'>Las claves nuevas no coinciden o estan vacias</font>";
			form.clave1.value="";
			form.clave2.value="";
			form.clave1.focus();
			return false;
			}
	}
//*******************************************************************************************
</script>	
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
			<div >
<!-- *************************************************************************************************** -->
			<form action="inicio_contrasena_cambiar.php" name="form" method="post" >
			<table width="400px" align="center">
				<tr>
					<td class="informacion_extra" >
					Ingrese su clave actual
					</td>
				</tr>
				<tr>
					<td  class="datos_extra">
					<input type="password" name="clave_antigua" >
					</td>
				</tr>
				<tr>
					<td class="informacion_extra" >
					Ingrese su nueva clave dos veces
					</td>
				</tr>
				<tr>
					<td  class="datos_extra">
					<input type="password" name="clave1" >
					</td>
				</tr>
				<tr>
					<td  class="datos_extra">
					<input type="password" name="clave2" >
					<div id="div_clave" ></div>
					</td>
				</tr>
				<tr>
					<td align="center" >
					<input type="button" title="Cambiar" value="Cambiar" onClick="verificar_igual();">
					</td>
				</tr>
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

