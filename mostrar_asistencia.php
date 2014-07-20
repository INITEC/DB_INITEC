<?php 
require_once("conexion1.php");
$id_fecha=$_POST["id_fecha"];

$sql="select * from reuniones where id_fecha='".$id_fecha."'";

$res=mysql_query($sql,$conexion);
if($reg=mysql_fetch_array($res)){
?>
<html>
<head>
<title>..::ASISTENCIA::..</title>
<style type="text/css">
	.encabezado { background-color:#666666; color:#FFFFFF; font-weight:bold }
	.registros { background-color:#f0f0f0}
	.url { text-decoration:none; color:#FFFFFF }
</style>
</head>
<body>

<table align="center" width="600" >
<tr>
<td align="center" valign="top" width="600" colspan="5">
<h3>Lista de Asistencia (<?php echo $reg["dia_semana"];?>_<?php echo $reg["dia"];?>-<?php echo $reg["mes"];?>-<?php echo $reg["ano"];?>)</h3>
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
</tr>
<?php 
$sql2="select * from integrantes,asistencias
	where asistencias.id_fecha='".$id_fecha."' AND integrantes.id_integrante=asistencias.id_integrante	";

$res2=mysql_query($sql2,$conexion);

while($reg2=mysql_fetch_array($res2)){
?>

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
<?php 
echo $reg2["hora"];
?>
</td>
<td align="center" valign="top" width="100" >
<?php 
echo $reg2["asistencia"];
?>
</td>
<td align="center" valign="top" width="100" >
<?php 
echo $reg2["condicion"];
?>
</td>
</tr>

<?php 
}
?>
<form action="index.php" method="post" name="terminar" >
<tr>
<td align="center" valign="top" width="600" colspan="5">
<input type="submit" value="Ir a pagina principal" title="Ir a pagina principal"/>
</td>
</tr>
</form>
</table>

</body>
</html>
<?php 
}
?>