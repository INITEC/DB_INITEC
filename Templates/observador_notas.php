<?php
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
require_once ("funciones/funciones_principales.php");
require_once ("funciones/funciones_menu.php");
require_once ("funciones/funciones_extra.php");

$id_integrante = $_SESSION["id_integrante"];
$tarea_actual = 'OBSERVADOR ASISTENCIAS';
$trabajo = $_SESSION["trabajo"];
?>

<html>
<head>
<title>..::<?php echo $tarea_actual; ?>::..</title>
<link href="css/estilos.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" language="javascript" src="js/validacion_input_1.js" ></script>
<script type="text/javascript" languaje="javascript" src="js/funciones_ajax.js"></script>
</head>
<body style="background-color:#88A6DC">

<?php
	$pasa = ver_pass($conexion,$id_integrante,$trabajo);
?>
	<div id="contenedor">			<!-- seccion del contenedor total -->
		<div id="cabecera_ob" >		<!-- seccion de la cabecera -->
			<?php
			if($pasa == 1){
				//	funcion de confirmar datos y cargar nuevos
				$usuario = cargar_datos($conexion,$id_integrante);
				//funcion de la parte superior
				cabecera($usuario);
			}
			else {
				//funcion de la parte superior del observador
				cabecera_observador();			
			}
			?>
		</div>
		<div id="cuerpo_tr" >	<!-- seccion del cuerpo -->
			<div id="menu_tr" >	<!-- seccion del menu -->
				<?php
					//funcion del menu izquierdo
					if($pasa == 1){
						menu($trabajo,$conexion,$tarea_actual);
					}
					else {
						menu_observador($trabajo,$conexion,$tarea_actual);			
					}
				?>
			</div>		
			<div id="presentacion_tr" >	<!-- seccion de la presentacion -->
				<?php
					// funcion de cuerpo
					presentacion_observador_notas($tarea_actual,$id_integrante,$conexion);
				?>
			</div>	
		</div>
	</div>


	<div id="pie" >		<!-- seccion del pie de pagina -->
	<?php
	// funcion de pie de pagina
	pie_pagina();
	?>
	</div>
</body>
</html>
