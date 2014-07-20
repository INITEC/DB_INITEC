<?php 
require_once("conexion1.php");
$id_fecha=$_POST["id_fecha"];

$sql="select * from reuniones where id_fecha='".$id_fecha."'";

$res=mysql_query($sql,$conexion);
if($reg=mysql_fetch_array($res)){
?>
<html>
<head>
<title>..::TOMA DE ASISTENCIA::..</title>
<style type="text/css">
	.encabezado { background-color:#666666; color:#FFFFFF; font-weight:bold }
	.registros { background-color:#f0f0f0}
	.url { text-decoration:none; color:#FFFFFF }
</style>
</head>
<body>

<table align="center" width="700" >
<tr>
<td align="center" valign="top" width="700" colspan="6">
<h3>Toma de Asistencia (<?php echo $reg["dia_semana"];?>_<?php echo $reg["dia"];?>-<?php echo $reg["mes"];?>-<?php echo $reg["ano"];?>)</h3>
<h4>Inicio <?php echo $reg["hora_inicio"];?></h4>
</td>
</tr>

<tr class="encabezado" >
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
<td align="center" valign="top" width="100" >
&nbsp;
</td>
</tr>
<?php 
$sql2="select * from integrantes order by id_integrante asc";
$res2=mysql_query($sql2,$conexion);

while($reg2=mysql_fetch_array($res2)){
?>
<form action="cargar_asistencia.php" method="post" name="form_<?php echo $reg2["id_integrante"]?>">
<tr class="registros" >
<td align="center" valign="top" width="50" >
<img src="foto_integrantes/<?php echo $reg2["foto"];?>" width="50" heigth="50" border="0" >
</td>
<td align="center" valign="top" width="250" >
<?php 
echo $reg2["integrante"];
?>
</td>
<td align="center" valign="top" width="100" >
<input type="text" name="hora" value="<?php echo $reg["hora_inicio"];?>" >
</td>
<td align="center" valign="top" width="100" >
<select name="asistencia">
<option value="Asistio">Asistio</option>
<option value="No Asistio">No Asistio</option>
</select>
</td>
<td align="center" valign="top" width="100" >
<select name="condicion">
<option value="Puntual">Puntual</option>
<option value="Tarde">Tarde</option>
<option value="Tarde injustificado">Tarde injustificado</option>
<option value="Injustificado">Injustificado</option>
<option value="Apoyo">Apoyo</option>
</select>
<?php 
$sql3="select count(*) as cuantos from asistencias where id_integrante='".$reg2["id_integrante"]."' AND 
		id_fecha='".$id_fecha."' ";
$res3=mysql_query($sql3,$conexion);
$reg3=mysql_fetch_array($res3);
$cantidad=$reg3["cuantos"];
if($cantidad != 0){
?>
</td>
<td align="center" valign="top" width="100" >
<img src="ima/bien.jpg" width="50" heigth="50" border="0" >
</td>
<?php 
} else {
?>

</td>
<td align="center" valign="top" width="100" >
<?php  echo $cantidad;?>
<input type="submit" value="Enviar" title="Enviar"/>
</td>
<?php 
}
?>

</tr>
<input type="hidden" name="id_integrante" value="<?php echo $reg2["id_integrante"];?>" >
<input type="hidden" name="id_fecha" value="<?php echo $reg["id_fecha"];?>" >
</form>
<?php 
}
?>
<form action="mostrar_asistencia.php" method="post" name="terminar" >
<tr>
<td align="center" valign="top" width="700" colspan="6">
<input type="submit" value="Terminar" title="Terminar de tomar asistencia"/>
</td>
</tr>
<input type="hidden" name="id_fecha" value="<?php echo $id_fecha;?>" >
</form>
</table>

</body>
</html>
<?php 
}
?>