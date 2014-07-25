<?php
if($acceso == 1) {
	?>
	<head>
		<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
	</head>
		
	<?php
	if( !empty($_GET)) {	
		if($_GET['estado'] == 0) {
			$id_grupo = $_GET["id"];
			if($grupo->desactivar_grupo($id_grupo)){
				?>
				<div id="dato_correcto">
					EL GRUPO A SIDO DESACTIVADO
				</div>
				<?php
			}else {
				?>
				<div id="dato_incorrecto">
					NO SE HA PODIDO DESACTIVAR AL GRUPO
				</div>
				<?php
			}
		}elseif($_GET['estado']== 1) {
			$id_grupo = $_GET["id"];
			if($grupo->activar_grupo($id_grupo)){
				?>
				<div id="dato_correcto">
					EL GRUPO A SIDO ACTIVADO
				</div>
				<?php
			}else {
				?>
				<div id="dato_incorrecto">
					NO SE HA PODIDO ACTIVAR AL GRUPO
				</div>
				<?php
			}
		}
	}
}
?>