<?php 
require_once("conexion1.php");
//$id_examen=$_POST["id_examen"];

$sql="select * from reuniones";

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

<table align="center" width="500" >
<tr>
<td align="center" valign="top" width="500" colspan="5">
<h3>LISTA DE TODAS LAS REUNIONES</h3>
</td>
</tr>

<tr class="encabezado" >
<td align="center" valign="top" width="100" >
Dia
</td>
<td align="center" valign="top" width="100" >
Fecha
</td>
<td align="center" valign="top" width="100" >
Hora inicio
</td>
<td align="center" valign="top" width="100" >
Hora final
</td>
<td align="center" valign="top" width="100" >
&nbsp;
</td>
</tr>
<?php 
while($reg=mysql_fetch_array($res)){
?>
<form action="mostrar_asistencia.php" method="post" name="ver_<?php echo $reg["id_fecha"]?>" target="_black" >
<tr class="registros" >

<td align="center" valign="top" width="100" >
<?php echo $reg["dia_semana"]; ?>
</td>
<td align="center" valign="top" width="100" >
<?php echo $reg["dia"]; ?>-<?php echo $reg["mes"]; ?>-<?php echo $reg["ano"]; ?>
</td>
<td align="center" valign="top" width="100" >
<?php echo $reg["hora_inicio"]; ?>
</td>
<td align="center" valign="top" width="100" >
<?php echo $reg["hora_final"]; ?>
</td>
<td align="center" valign="top" width="100" >
<input type="submit" value="Ver" title="Ver" >
</td>
</tr>
<input type="hidden" name="id_fecha" value="<?php echo $reg["id_fecha"];?>" >
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
