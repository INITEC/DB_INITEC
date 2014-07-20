<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"]){
	$tarea_actual="AD DEUDAS";
$sql="select * from integrantes where id_integrante='".$_SESSION["id_integrante"]."'";
$inicia_usuario=mysql_query($sql,$conexion);
$usuario=mysql_fetch_array($inicia_usuario);
?>
<html>
<head>
<title>..::AD DEUDAS::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
<script type="text/javascript" language="javascript" >
	function validar_datos(){
		var form=document.reun;
//******************************************************************************************
		if (form.nombre_deuda.value == "0" ){
			document.getElementById("div_nombre_deuda").innerHTML="<font color='#ff0000'>Escriba un nombre</font>";
			form.nombre_deuda.value="0";
			form.nombre_deuda.focus();
			return false;
			}
		else {
			document.getElementById("div_nombre_deuda").innerHTML="";
			}
//******************************************************************************************
		if (form.cantidad.value=="0"){
			document.getElementById("div_cantidad").innerHTML="<font color='#ff0000'>Debe poner una deuda coherente</font>";
			form.cantidad.value="";
			form.cantidad.focus();
			return false;
			}
		else {
			document.getElementById("div_cantidad").innerHTML="";
			}
//******************************************************************************************
		if (form.fecha_final.value=="0" || form.fecha_final.value=="0000-00-00" ){
			document.getElementById("div_fecha_final").innerHTML="<font color='#ff0000'>Elija una fecha</font>";
			form.fecha_final.value="0000-00-00";
			form.fecha_final.focus();
			return false;
			}
		else {
			document.getElementById("div_fecha_final").innerHTML="";
			}
//******************************************************************************************
			document.reun.submit();
		}
	function limpiar(){
		document.reun.reset();
		document.reun.nom.focus();
		}
</script>
</head>
<body style="background-color:#88A6DC" onLoad="limpiar()" >
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
		<form action="AD_deudas_crear.php" method="post" name="reun">
		<table align="center" width="400" >
			        <?php
					date_default_timezone_set('America/Los_Angeles');
					$dia=date(d);
					$mes=date(n);
					$ano=date(Y);
					?>
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Nombre de la deuda:
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="nombre_deuda" value="<?php echo mes_text($mes); ?>" >
					<div id="div_nombre_deuda" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Ultimo dia de pago:
				</td>
				<td valign="top" align="left" width="200" >
					
					<input type="text" name="fecha_final" value="<?php echo "$ano-$mes-$dia";?>" >
					<div id="div_fecha_final" ></div>
				</td>
			</tr>
			
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Cantidad de Pago(Soles):
				</td>
				<td valign="top" align="left" width="200" >
					<input type="text" name="cantidad" value="10" >
					<div id="div_cantidad" ></div>
				</td>
			</tr>
			<tr>
				<td valign="top" width="200" class="informacion_extra" >
					Encargado de Cobrar:
				</td>
				<td valign="top" width="200" class="informacion_extra" >
						<select name="cobrador">
					<?php 
					$inte="select id_integrante,integrante,estado from integrantes where estado='activo' order by integrante asc";
					$res_inte=mysql_query($inte,$conexion);
					while($reg_inte=mysql_fetch_array($res_inte)){
					?>					
						<option value="<?php echo $reg_inte["id_integrante"];?>"><?php echo $reg_inte["integrante"];?></option>
					<?php } ?>
						</select>
				</td>
			</tr>
			
				<input type="hidden" name="fecha_creada" value="<?php echo "$ano-$mes-$dia"; ?>" >
                <input type="hidden" name="tarea" value="<?php echo $tarea_actual; ?>" >
			<tr>
				<td align="center" valign="top" width="400" colspan="2" >
					<input type="button" title="Crear" value="..::Crear::.." onClick="validar_datos()" >
				</td>
			</tr>
		</table>
		</form>
<!-- *************************************************************************************************** -->			
		<hr>			
<?php 
$sql="select * from deudas order by id_deuda desc";
$res=mysql_query($sql,$conexion);
?>
		<table align="center" width="650" >				
			<tr class="encabezado_tabla" >
				<td align="center" valign="top" width="150" >
				Nombre de la Deuda
				</td>
				<td align="center" valign="top" width="150" >
				Fecha creada
				</td>
				<td align="center" valign="top" width="150" >
				Fecha limite
				</td>
				<td align="center" valign="top" width="150" >
				Cantidad
				</td>
				<td valign="top" align="center" width="25" >&nbsp;
					
				</td>
				<td valign="top" align="center" width="25" >&nbsp;
					
				</td>
				<td valign="top" align="center" width="25" >&nbsp;
					
				</td>
			</tr>
<?php 
while($reg=mysql_fetch_array($res)){
?>
			<tr class="registros_tabla" >
				<td align="center" valign="top" width="150" >
					<?php echo $reg["nombre_deuda"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["fecha_creada"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["fecha_final"]; ?>
				</td>
				<td align="center" valign="top" width="150" >
					<?php echo $reg["cantidad"]; ?>
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ver mas" src="ima/desplazar_abajo.png"  width="25px"
					onclick="from('<?php echo $reg["id_deuda"]; ?>','ver_mas_<?php echo $reg["id_deuda"]; ?>','observador_deudas_mostrar.php')">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Ocultar info" src="ima/desplazar_arriba.png" width="25px"
					onclick="document.getElementById('ver_mas_<?php echo $reg["id_deuda"]; ?>').innerHTML=''">
				</td>
				<td valign="top" align="center" width="25" >
					<img title="Editar" src="ima/editar.png" width="20px"
					onClick="document.form_<?php echo $reg["id_deuda"];?>.submit()">
					<!-- ************************************************************ -->
					<form action="AD_deudas_editar.php" method="post" name="form_<?php echo $reg["id_deuda"];?>" >
					<input type="hidden" name="id_deuda" value="<?php echo $reg["id_deuda"];?>" >
					<input type="hidden" name="tarea" value="<?php echo $tarea_actual; ?>" >
					</form>
					<!-- ************************************************************ -->
				</td>
			</tr>
			<tr>
				<td width="450" colspan="6" >
				<div id="ver_mas_<?php echo $reg["id_deuda"]; ?>" >
				</div>	
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

