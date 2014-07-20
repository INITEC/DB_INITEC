<?php 
require_once("conexion1.php");
//$id_examen=$_POST["id_examen"];

$sql="select * from examenes";

$res=mysql_query($sql,$conexion);
?>
<html>
<head>
<title>..::BUSCAR RESULTADOS::..</title>
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
<h3>LISTA DE TODAS LAS NOTAS</h3>
</td>
</tr>

<tr class="encabezado" >
<td align="center" valign="top" width="50" >
Examen
</td>
<td align="center" valign="top" width="250" >
Fecha
</td>
<td align="center" valign="top" width="100" >
En base a
</td>
<td align="center" valign="top" width="100" >
Nota aprobatoria
</td>
<td align="center" valign="top" width="100" >
&nbsp;
</td>
</tr>
<?php 
while($reg=mysql_fetch_array($res)){
?>
<form action="mostrar_notas.php" method="post" name="ver_<?php echo $reg["id_examen"]?>" target="_black" >
<tr class="registros" >

<td align="center" valign="top" width="300" >
<?php echo $reg["examen"]; ?>
</td>
<td align="center" valign="top" width="300" >
<?php echo $reg["fecha"]; ?>
</td>
<td align="center" valign="top" width="300" >
<?php echo $reg["n_maxima"]; ?>
</td>
<td align="center" valign="top" width="300" >
<?php echo $reg["n_aprobatoria"]; ?>
</td>
<td>
<input type="submit" value="Ver" title="Ver" >
</td>
</tr>
<input type="hidden" name="id_examen" value="<?php echo $reg["id_examen"];?>" >
</form>
<?php 
}
?>
<form action="index.php" method="post" name="terminar" >
<tr>
<td align="center" valign="top" width="700" colspan="5">
<input type="submit" value="Ir pagina principal" title="Ir pagina principal"/>
</td>
</tr>
</form>
</table>

</body>
</html>
