<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
if($id_persona) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
    require_once ("../require/grupos_class.php");
	
	$tarea_actual = "AD_DEUDAS";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_persona);
    $id_trabajo = $integrante->retornar_id_trabajo();
    
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {
		$trabajos = new trabajos_int();
		$tareas = new tareas_int();
        $grupo = new grupos();
/* ..................................................................................................................... */
?>
<html>
    <head>
    <title>..::<?php echo $tarea_actual; ?>::..</title>
    <link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
    <script type="text/javascript" languaje="javascript" src="../JavaScript/limpiar_elemento.js"></script>
    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>

    <link rel="stylesheet" type="text/css" media="all" href="../Estilos/calendar-estilo.css" />
    <script type="text/javascript" src="../JavaScript/calendar/calendar.js"></script>
    <script type="text/javascript" src="../JavaScript/calendar/calendar-es.js"></script>
    <script type="text/javascript" src="../JavaScript/calendar/calendar-setup.js"></script>

    <script type='text/javascript' languaje='javascript'>
        function cargar_cuadro_crear_deuda (){
            $parametros = {
                'boton-cuadro-crear-deuda' : true
            };
            $.ajax({
                url: 'AD_deudas_aux.php',
                type: 'POST',
                async: true,
                data: $parametros,
                success: function (datos){
                    $("#cuadro_crear_deuda").html(datos);
                }
            });
        }
        
        function cargar_cuadro_ver_deudas (){
            $parametros = {
                'boton-cuadro-ver-deudas' : true
            };
            $.ajax({
                url: 'AD_deudas_aux.php',
                type: 'POST',
                async: true,
                data: $parametros,
                success: function (datos){
                    $("#cuadro_ver_deudas").html(datos);
                }
            });
        }
        
        window.onload = function(){
            cargar_cuadro_crear_deuda();
            cargar_cuadro_ver_deudas();
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
                    <div >
<!-- *************************************************************************************************** -->
                        <br>
                        <div id="cuadro_crear_deuda" >
                            <!-- Aca aparecera el cuadro de crear deuda de la respuesta del ajax -->
                        </div>
                        <hr>
                        <div id="cuadro_ver_deudas" >
                            <!-- Aca aparecera el cuadro deudas de la respuesta del ajax -->
                        </div>
<!-- *************************************************************************************************** -->			
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
/* ................................................................................................................. */
	} else {
        include_once ("../Include/no_tarea.php");
    }	
} else {
    include_once ("../Include/no_acceso.php");
}

?>