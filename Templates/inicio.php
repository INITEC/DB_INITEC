<?php
session_start();
require_once ("conexion1.php");
require_once ("verificar_usuario.php");
require_once ("funciones/funciones_principales.php");
require_once ("funciones/funciones_menu.php");
require_once ("funciones/funciones_extra.php");

$id_integrante = $_SESSION["id_integrante"];
$tarea_actual = 'HOME';
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
	
if($pasa == 1){

	//	funcion de confirmar datos y cargar nuevos
	$usuario = cargar_datos($conexion,$id_integrante);
?>
	<div id="contenedor">			<!-- seccion del contenedor total -->
		<div id="cabecera_ob" >		<!-- seccion de la cabecera -->
			<?php
				//funcion de la parte superior
				cabecera($usuario);
			?>
		</div>
		<div id="cuerpo_tr" >	<!-- seccion del cuerpo -->
			<div id="menu_tr" >	<!-- seccion del menu -->
				<?php
					//funcion del menu izquierdo
					menu ($trabajo,$conexion,$tarea_actual);
				?>
			</div>		
			<div id="presentacion_tr" >	<!-- seccion de la presentacion -->
				<?php
					// funcion de cuerpo de HOME
					presentacion_HOME($tarea_actual,$id_integrante);
				?>
			</div>	
		</div>
	</div>
<?php	
} else {
	denegar_ingreso();
}
?>

	<div id="pie" >		<!-- seccion del pie de pagina -->
	<?php
	//funcion de pie de pagina
	pie_pagina();
	?>
	</div>
</body>
</html>