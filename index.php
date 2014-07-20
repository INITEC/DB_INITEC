<html>
<head>
<title>..::INITEC::..</title>
<script type="text/javascript" language="javascript" >
	function cambiar(id,color){
		document.getElementById(id).style.backgroundColor=color;
		}
</script>
<style type="text/css">
	#principal {width:800px; heigth:100px }
	#header {width:960px; height:311px; float:left; background-color:#666666; color:#FFFFFF}
	#menu {width:960px; height:50px; float:left}
	.boton {width:480px; height:50px; float:left; background-color:#666666; color:#FFFFFF}
	.url { text-decoration:none; color:#FFFFFF }
</style>
</head>

<body>
<div id="principal" >
<div align="center" id="header" >
<img src="ima/initec_presentacion.jpg" width="960" heigth="311" border="0">
</div>
<div id="menu" >
<div id="integrantes" class="boton" align="center" onMouseMove="cambiar('integrantes','#999999');" onMouseOut="cambiar('integrantes','#666666')">
<a href="javascript:void(0)" class="url" onClick="window.location='integrantes.php'" ><h2>INTEGRANTES</h2></a>
</div>
<div id="asistencia" class="boton" align="center" onMouseMove="cambiar('asistencia','#999999');" onMouseOut="cambiar('asistencia','#666666')">
<a href="javascript:void(0)" class="url" onClick="window.location='asistencia.php'"><h2>ASISTENCIA</h2></a>
</div>
</div>
</div>
</body>
</html>