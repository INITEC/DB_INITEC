<?php 
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
if($_SESSION["id_integrante"] and $_POST["tarea"]=="AD ASISTENCIAS"){
	$tarea_actual="AD ASISTENCIAS EDITAR";
$sql="select * from integrantes where id_integrante='".$_SESSION["id_integrante"]."'";
$inicia_usuario=mysql_query($sql,$conexion);
$usuario=mysql_fetch_array($inicia_usuario);
?>
<html>
<head>
<title>..::<?php echo $tarea_actual;?>::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
<script type="text/javascript" language="javascript">
	//*****************************************************************************************
	function mueveReloj(){
		momentoActual = new Date()
	    hora = momentoActual.getHours()
	    minuto = momentoActual.getMinutes()
	    segundo = momentoActual.getSeconds()

	    str_segundo = new String (segundo)
	    if (str_segundo.length == 1)
	       segundo = "0" + segundo

	    str_minuto = new String (minuto)
	    if (str_minuto.length == 1)
	       minuto = "0" + minuto

	    str_hora = new String (hora)
	    if (str_hora.length == 1)
	       hora = "0" + hora 
		horaImprimible = hora + ":" + minuto + ":" + segundo
		document.form_reloj.reloj.value= horaImprimible
		setTimeout("mueveReloj()",1000)	}
	//***********************************************************************************
	function Marcar(form){
		var limite_de_tiempo = 15
		inicio=document.inicio.hora_inicio.value
		entrada=document.form_reloj.reloj.value
		form.hora.value=entrada
		form.asistencia.value="Asistio"
		//***********************************************************************************
		//programa que resta las horas
		    horas1=entrada.split(":"); /*Mediante la función split separamos el string por ":" y lo convertimos en array. */
		    horas2=inicio.split(":");
		    horatotale=new Array();
//		    for(a=0;a<3;a++) /*bucle para tratar la hora, los minutos y los segundos*/
//		    {
//		
//		        horas1[a]=(isNaN(parseInt(horas1[a])))?0:parseInt(horas1[a]) /*si horas1[a] es NaN lo convertimos a 0, sino convertimos el valor en entero*/
//		        horas2[a]=(isNaN(parseInt(horas2[a])))?0:parseInt(horas2[a])
//		        horatotale[a]=(horas1[a]-horas2[a]);/* insertamos la resta dentro del array horatotale[a].*/
//		
//		    }
					entrada=horas1[0]*60
					inicio=horas2[0]*60
					entrada=entrada + horas1[1]
		    		inicio=inicio + horas2[1]
		    		retardo = entrada - inicio
		    horatotal=new Date()  /*Instanciamos horatotal con la clase Date de javascript para manipular las horas*/
		    horatotal.setHours(horatotale[0]); /* En horatotal insertamos las horas, minutos y segundos calculados en el bucle*/
		    horatotal.setMinutes(horatotale[1]);
		    horatotal.setSeconds(horatotale[2]);
		    //form.hora.value=horatotal.getHours()+":"+horatotal.getMinutes()+":"+horatotal.getSeconds();
		    //form.hora.value=retardo
		    if(retardo > limite_de_tiempo ){
				if(form.condicion.value != "Tarde justificado"){form.condicion.value="Tarde" } }
		    else {form.condicion.value="Puntual"}
		    /*return horatotal.getHours()+":"+horatotal.getMinutes()+":"+
		    horatotal.getSeconds();*/
		    /*Devolvemos el valor calculado en el formato hh:mm:ss*/
		    form.submit()
		//***********************************************************************************
				
		}
	//***********************************************************************************
</script>
</head>
<body style="background-color:#88A6DC" onload="mueveReloj()" >
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
<?php 
$sql="select * from reuniones where id_fecha='".$_POST["id_fecha"]."'";
$res=mysql_query($sql,$conexion);
$reg=mysql_fetch_array($res)
?>
	<table align="center" width="700" >
	<tr>
		<td align="center" valign="top" width="700" colspan="7" style="color:#FFFFFF">
			<h3>Toma de Asistencia (<?php echo $reg["dia_semana"];?> - <?php echo $reg["fecha"];?>)</h3>
		</td>
	</tr>
	<tr>
			<td align="center" valign="top" width="50" style="color:#FFFFFF" >
				&nbsp;
			</td>
			<td align="right" valign="top" width="250" style="color:#FFFFFF" >
				<h4>Inicio:</h4>
			</td>
			<td align="left" valign="top" width="100" style="color:#FFFFFF" >
				<form name="inicio" >
				<input type="text" name="hora_inicio" readonly="readonly" size="10" style="background-color : Black; color : White; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_reloj.reloj.blur()" value="<?php echo $reg["hora_inicio"];?>" >
				</form>
			</td>
			<td align="right" valign="top" width="100" style="color:#FFFFFF" >
				<h4>Hora Actual:</h4>
			</td>
			<td align="left" valign="top" width="100" style="color:#FFFFFF" >
				<form name="form_reloj">
				<input type="text" name="reloj" size="10" style="background-color : Black; color : White; font-family : Verdana, Arial, Helvetica; font-size : 8pt; text-align : center;" onfocus="window.document.form_reloj.reloj.blur()"> 
				</form>
			</td>
			<td align="center" valign="top" width="80" style="color:#FFFFFF" >
				&nbsp;
			</td>
			<td align="center" valign="top" width="80" style="color:#FFFFFF" >
				&nbsp;
			</td>
			<td align="center" valign="top" width="80" style="color:#FFFFFF" >
				&nbsp;
			</td>
	</tr>

	<tr class="informacion_extra" >
	<td align="center" valign="top" width="50" >
	Foto
	</td>
	<td align="center" valign="top" width="250" >
	Nombre
	</td>
	<td align="center" valign="top" width="100" >
	Hora
	</td>
	<td align="center" valign="top" width="100" >
	Asistencia
	</td>
	<td align="center" valign="top" width="100" >
	Condicion
	</td>
	<td align="center" valign="top" width="80" >
	&nbsp;
	</td>
	<td align="center" valign="top" width="80" >
	&nbsp;
	</td>
	</tr>
	<?php 
	$sql2="select * from integrantes where estado='activo' order by integrante asc";
	$res2=mysql_query($sql2,$conexion);
	
	while($reg2=mysql_fetch_array($res2)){
	?>
		<tr class="datos_extra" >
			<td align="center" valign="top" width="50" >
				<img src="foto_integrantes/<?php echo $reg2["foto"];?>" width="50" heigth="50" border="0" >
			</td>
			<td align="center" valign="top" width="250" >
				<?php 
				echo $reg2["integrante"];
				?>
			</td>
			<!-- ********************************************************************* -->
			<?php 
			$sql3="select * from asistencias where id_integrante='".$reg2["id_integrante"]."' AND 
					id_fecha='".$_POST["id_fecha"]."' ";
			$res3=mysql_query($sql3,$conexion);
			if($reg3=mysql_fetch_array($res3)){
			?>
				<form action="AD_asistencias_editar_cambiar.php" method="post" name="form_<?php echo $reg2["id_integrante"]?>">
				<td align="center" valign="top" width="100" >
					<input type="text" name="hora" value="<?php echo $reg3["hora"];?>" >
				</td>
				<td align="center" valign="top" width="100" >
					<select name="asistencia">
						<option <?php if($reg3["asistencia"]=="Asistio"){echo "selected";}?> value="Asistio">Asistio</option>
						<option <?php if($reg3["asistencia"]=="No Asistio"){echo "selected";}?> value="No Asistio">No Asistio</option>
					</select>
				</td>
				<td align="center" valign="top" width="100" >
					<select name="condicion">
						<option <?php if($reg3["condicion"]=="Puntual"){echo "selected";}?> value="Puntual">Puntual</option>
						<option <?php if($reg3["condicion"]=="Retrasado justificado"){echo "selected";}?> value="Retrasado justificado">Retrasado justificado</option>
						<option <?php if($reg3["condicion"]=="Tarde justificado"){echo "selected";}?> value="Tarde justificado">Tarde justificado</option>
						<option <?php if($reg3["condicion"]=="Justificado"){echo "selected";}?> value="Justificado">Justificado</option>
						<option <?php if($reg3["condicion"]=="Retrasado"){echo "selected";}?> value="Retrasado">Retrasado</option>
						<option <?php if($reg3["condicion"]=="Tarde"){echo "selected";}?> value="Tarde">Tarde</option>
						<option <?php if($reg3["condicion"]=="Injustificado"){echo "selected";}?> value="Injustificado">Injustificado</option>
						<option <?php if($reg3["condicion"]=="Apoyo"){echo "selected";}?> value="Apoyo">Apoyo</option>
					</select>
				</td>
				<td align="center" valign="top" width="100" >
					<input type="submit" value="Cambiar" title="Cambiar"/>
				</td>
				<td align="center" valign="top" width="100" >
					&nbsp;
				</td>
			<?php 
			} else {
			?>
				<form action="AD_asistencias_editar_enviar.php" method="post" name="form_<?php echo $reg2["id_integrante"]?>">
				<td align="center" valign="top" width="100" class="datos_extra_2" >
					<input type="text" name="hora" value="<?php echo $reg["hora_inicio"];?>" >
				</td>
				<td align="center" valign="top" width="100" class="datos_extra_2" >
					<select name="asistencia">
						<option value="Asistio">Asistio</option>
						<option value="No Asistio">No Asistio</option>
					</select>
				</td>
				<td align="center" valign="top" width="100" class="datos_extra_2" >
					<select name="condicion">
						<option value="Puntual">Puntual</option>
						<option value="Retrasado justificado">Retrasado justificado</option>
						<option value="Tarde justificado">Tarde justificado</option>
						<option value="Justificado">Justificado</option>
						<option value="Retrasado">Retrasado</option>
						<option value="Tarde">Tarde</option>
						<option value="Injustificado">Injustificado</option>
						<option value="Apoyo">Apoyo</option>
					</select>
				</td>
				<td align="center" valign="top" width="100" class="datos_extra_2" >
					<input type="submit" value="Enviar" title="Enviar"/>
				</td>
				<td align="center" valign="top" width="100" class="datos_extra_2" >
					<input type="button" value="Marcar" title="Marcar" onClick="Marcar(document.form_<?php echo $reg2["id_integrante"]?>)" />
				</td>
			<?php 
			}
			?>
			<!-- *************************************************************************************** -->		
				</tr>
				<input type="hidden" name="id_integrante" value="<?php echo $reg2["id_integrante"];?>" >
				<input type="hidden" name="id_fecha" value="<?php echo $_POST["id_fecha"];?>" >
				<input type="hidden" name="tarea" value="<?php echo $_POST["tarea"];?>" >
				</form>
		<!-- ********************************************************************* -->
	<?php 
	}
	?>
	<form action="AD_asistencias.php" method="post" name="terminar" >
	<tr>
	<td align="center" valign="top" width="700" colspan="6">
	<input type="submit" value="Terminar" title="Terminar de tomar asistencia"/>
	</td>
	</tr>
	</form>
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

