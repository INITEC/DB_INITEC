<?php 
require_once("conexion1.php");
$id_examen=$_POST["id_examen"];

$sql="select * from examenes where id_examen='".$id_examen."'";

$res=mysql_query($sql,$conexion);
if($reg=mysql_fetch_array($res)){
?>
<html>
<head>
<title>..::NOTAS::..</title>
<style type="text/css">
	.encabezado { background-color:#666666; color:#FFFFFF; font-weight:bold }
	.registros { background-color:#f0f0f0}
	.url { text-decoration:none; color:#FFFFFF }
</style>
</head>
<body>

<table align="center" width="600" >
<tr>
<td align="center" valign="top" width="600" colspan="4">
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
</tr>
<?php 
$sql2="select * from integrantes,notas
	where notas.id_examen='".$id_examen."' AND integrantes.id_integrante=notas.id_integrante";

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
echo $reg2["nota"];
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
<td align="center" valign="top" width="600" colspan="4">
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