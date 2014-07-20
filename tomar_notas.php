<?php 
require_once("conexion1.php");
$id_examen=$_POST["id_examen"];

$sql="select * from examenes where id_examen='".$id_examen."'";

$res=mysql_query($sql,$conexion);
if($reg=mysql_fetch_array($res)){
?>
<html>
<head>
<title>..::LLENADO DE NOTAS::..</title>
<style type="text/css">
	.encabezado { background-color:#666666; color:#FFFFFF; font-weight:bold }
	.registros { background-color:#f0f0f0}
	.url { text-decoration:none; color:#FFFFFF }
</style>
</head>
<body>

<table align="center" width="700" >
<tr>
<td align="center" valign="top" width="700" colspan="5">
<h3>Llenado de Notas del Examen del (<?php echo $reg["fecha"];?>)</h3>
<h4>Nota Aprobatoria <?php echo $reg["n_aprobatoria"];?></h4>
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
Nota
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
<form action="cargar_notas.php" method="post" name="form_<?php echo $reg2["id_integrante"]?>">
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
<input type="text" name="nota" value="<?php echo $reg["n_maxima"];?>" >
</td>
<td align="center" valign="top" width="100" >
<select name="condicion">
<option value="Aprobado">Aprobado</option>
<option value="Desaprobado">Desaprobado</option>
</select>

<?php 
$sql3="select count(*) as cuantos from notas where id_integrante='".$reg2["id_integrante"]."' AND 
		id_examen='".$id_examen."' ";
$res3=mysql_query($sql3,$conexion);
$reg3=mysql_fetch_array($res3);
$cantidad=$reg3["cuantos"];
if($cantidad != 0){
?>
<td align="center" valign="top" width="100" >
<img src="ima/bien.jpg" width="50" heigth="50" border="0" >
</td>
<?php 
} else {
?>
<td align="center" valign="top" width="100" >
<input type="submit" value="Enviar" title="Enviar"/>
</td>
<?php 
}
?>

</tr>
<input type="hidden" name="id_integrante" value="<?php echo $reg2["id_integrante"];?>" >
<input type="hidden" name="id_examen" value="<?php echo $reg["id_examen"];?>" >
</form>
<?php 
}
?>
<form action="mostrar_notas.php" method="post" name="terminar" >
<tr>
<td align="center" valign="top" width="700" colspan="5">
<input type="submit" value="Terminar" title="Terminar subir las notas"/>
</td>
</tr>
<input type="hidden" name="id_examen" value="<?php echo $id_examen;?>" >
</form>
</table>

</body>
</html>
<?php 
}
?>