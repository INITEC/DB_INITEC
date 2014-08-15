<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
if($id_persona) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	require_once ("../require/grupos_class.php");
	
	$tarea_actual = "HORAS_TRABAJO";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_persona);
	$id_trabajo = $integrante->retornar_id_trabajo();
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {
		$grupo = new grupos();
/* ..................................................................................................................... */
?>
<html>
	<head>
	<title>..::<?php echo $tarea_actual; ?>::..</title>
	<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
	<script type="text/javascript" language="javascript" src="../JavaScript/validacion_input_1.js" ></script>
	<script src="http://code.jquery.com/jquery-1.11.1.js"></script>
	
	<link rel="stylesheet" type="text/css" media="all" href="../Estilos/calendar-estilo.css" />
    <script type="text/javascript" src="../JavaScript/calendar/calendar.js"></script>
    <script type="text/javascript" src="../JavaScript/calendar/calendar-es.js"></script>
    <script type="text/javascript" src="../JavaScript/calendar/calendar-setup.js"></script>
	
	<script type='text/javascript' languaje='javascript'>
        function cargar_cuadro_ingreso_horas (){
            $parametros = {
                'boton-cuadro-ingreso-horas' : true
            };
            $.ajax({
                url: 'horas_trabajo_aux.php',
                type: 'POST',
                async: true,
                data: $parametros,
                success: function (datos){
                    $("#ingreso_horas").html(datos);
                }
            });
        }
        
        function cargar_lista_horas_integrante (){
            $parametros = {
                'boton-lista-horas-integrante' : true
            };
            $.ajax({
                url: 'horas_trabajo_aux.php',
                type: 'POST',
                async: true,
                data: $parametros,
                success: function (datos){
                    $("#lista_horas_integrante").html(datos);
                }
            });
        }
        
        window.onload = function(){
            cargar_cuadro_ingreso_horas();
            cargar_lista_horas_integrante ();
        }
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
			<!-- ***************************************************************************************** -->
			<br>
			<div id="subtitulo1">
				<form id="validacion_horas" action="horas_trabajo_aux.php" method="POST">
					<input type="submit" name="Validar_horas_trab" value="VALIDAR HORAS DE TRABAJO">
				</form>
			</div>
			<div id="ingreso_horas" >
				
			</div>
			<hr>
			<div id="lista_horas_integrante">
				
			</div>
			<!-- ************************************************************************************************** -->			
		</div>	
		</div>
	</div>
		<div id="pie_pagina_tr">
			<?php include_once("../Include/pie_pagina.php");?>
		</div>
	</body>
</html>

<?php 
/* ................................................................................................................. */
			}
	else {
			include_once ("../Include/no_tarea.php");
			}	
		}
else {
		include_once ("../Include/no_acceso.php");
		}

?>
