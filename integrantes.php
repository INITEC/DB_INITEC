<?php 
require_once("conexion1.php");
?>

<html>
<head>
<title>..::Integrantes INITEC::..</title>
<script type="text/javascript" language="javascript" >
	function cambiar(id,color){
		document.getElementById(id).style.backgroundColor=color;
		}
</script>
<style type="text/css">
	.encabezado { background-color:#666666; color:#FFFFFF; font-weight:bold }
	.registros { background-color:#f0f0f0}
	.url { text-decoration:none; color:#FFFFFF }
</style>
<script type="text/javascript" language="javascript" >
	function eliminar(id){
		if(confirm("¿Realmente desea eliminar el registro?")){
		window.location="eliminar.php?id_integrante="+id;
		}
	}
</script>
</head>
<body>
<table width="700" align="center" >

<tr>
<td valign="top" align="center" width="700" colspan="6" >
<h1>Datos Basicos de los Integrantes</h1>
</td>
</tr>
<tr class="encabezado" >
<td valign="top" align="center" width="200" >
Integrante
</td>
<td valign="top" align="center" width="100" >
Celular
</td>
<td valign="top" align="center" width="300" >
Gmail
</td>
<td valign="top" align="center" width="50" >
Foto
</td>
<td valign="top" align="center" width="25" >
&nbsp;
</td>
<td valign="top" align="center" width="25" >
&nbsp;
</td> 
</tr>

<?php 
$sql="select * from integrantes order by integrante asc";
$res=mysql_query($sql,$conexion);
while ($reg=mysql_fetch_array($res)){
?>
<tr class="registros" >
<td valign="top" align="center" width="200" >
<?php 
echo $reg["integrante"];
?>
</td>
<td valign="top" align="center" width="100" >
<?php 
echo $reg["celular"];
?>
</td>
<td valign="top" align="center" width="300" >
<?php 
echo $reg["gmail"];
?>
</td>
<td valign="top" align="center" width="50" >
<img src="foto_integrantes/<?php echo $reg["foto"];?>" width="50" heigth="50" border="0" >
</td>
<td valign="top" align="center" width="25" >
<a href="editar.php?id_integrante=<?php echo $reg["id_integrante"];?>" title="Editar"><img src="ima/editar.png" border="0"></a>
</td>
<td valign="top" align="center" width="25" >
<a href="javascript:void(0)" title="Eliminar" onClick="eliminar(<?php echo $reg['id_integrante'];?>)" ><img src="ima/eliminar.png" border="0"></a>
</td> 
</tr>
<?php 
}
?>
<tr>
<td class="encabezado" valign="top" align="center" width="300" colspan="2" id="inicio" onMouseMove="cambiar('inicio','#999999');" onMouseOut="cambiar('inicio','#666666')">
<a href="javascript:void(0)" class="url" onClick="window.location='index.php'" title="Ir a la pagina principal" ><h2>Pagina Principal</h2></a>
</td>
<td class="encabezado" valign="top" align="center" width="300" colspan="1" id="ver" onMouseMove="cambiar('ver','#999999');" onMouseOut="cambiar('ver','#666666')">
<a href="javascript:void(0)" class="url" onClick="window.location='ver_completo.php'" title="Datos completos" ><h2>Ver datos completos</h2></a>
</td>
<td valign="top" align="right" width="100" colspan="3" >
<a href="agregar.php" title="Agregar integrante"><img src="ima/agregar.png" border="0" ></a>
</td>
</tr>

</table>
</body>
</html>