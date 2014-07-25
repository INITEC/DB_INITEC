<?php 
if($acceso == 1) {	
?>
<html>
	<head>
	<title>..::<?php echo $tarea_actual; ?>::..</title>
	<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
	<script type="text/javascript" language="javascript" src="../JavaScript/validacion_input_1.js" ></script>
	<script type="text/javascript" languaje="javascript" src="../JavaScript/from_2_ajax.js"></script>
	<script type="text/javascript" languaje="javascript" src="../JavaScript/callDivs_1_ajax.js"></script>
	<script type="text/javascript" >
			window.onload = function startrefresh(){
			callDivs_1 ('tabla_grupos','AD_grupos_aux.php','1');
			}
			function cambiar_estado(id,estado,ide,url,secs){
		from_2(id,estado,ide,url);
		setTimeout(function(){callDivs_1 ('tabla_grupos','AD_grupos_aux.php','1');},secs*1000);}
	</script>
	</head>
	<body style="background-color:#88A6DC">
	<div id="contenedor_tr">
		<div id="cabecera_tr">
				<?php include_once("../Include/cabecera_tarea.php");?>
		</div>
		<div id="cuerpo_tr">
				<div id="menu_izquierda_tr">
					<?php include_once("../Include/menu_obligaciones.php");?>
				</div>
		<div id="presentacion_tr" >
			<div id="titulo_tr" >
			<h1><?php echo $tarea_actual; ?></h1>
			</div>
			<br>
			<div id="tabla_grupos">
	
			</div>
		</div>	
		</div>
	</div>
		<div id="pie_pagina_tr">
			<?php include_once("../Include/pie_pagina.php");?>
		</div>
	</body>
</html>

<?php
}
else {
	include_once ("../Include/no_acceso.php");
}

?>