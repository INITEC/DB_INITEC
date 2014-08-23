<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
if($id_persona) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
    require_once ("../require/grupos_class.php");
	
	$tarea_actual = "AD_ASISTENCIAS";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_persona);
    $id_trabajo = $integrante->retornar_id_trabajo();
    
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {
		$trabajos = new trabajos_int();
		$tareas = new tareas_int();
        $grupo = new grupos();
        $id_reunion_env = $_POST["id_reunion"];
/* ..................................................................................................................... */
?>
<html>
<head>
<title>..::<?php echo $tarea_actual; ?>::..</title>
<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
<link href="../Estilos/asistencias.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" languaje="javascript" src="AD_asistencias/mueveReloj.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.js"></script>

<script type='text/javascript' languaje='javascript'>
	function cargar_cuadro_marcar_asistencia (){
        $parametros = {
            'boton-ver-cuadro-marcar-asistencia' : true,
            'id_reunion' : <?php echo $id_reunion_env; ?>
        };
        $.ajax({
            url: 'AD_asistencias_aux.php',
            type: 'POST',
            async: true,
            data: $parametros,
            success: function (datos){
                $("#cuadro").html(datos);
            }
        });
    }
    
    function Reloj (){
        var now = new Date(); 
        var hour = now.getHours();
        var minute = now.getMinutes();
        var second = now.getSeconds();

        hour = ( hour < 10 )? "0"+hour : hour;
        minute = ( minute < 10 )? "0"+minute : minute;
        second = ( second < 10 )? "0"+second : second;
        $("#hora_actual").html('Hora Actual: '+hour+':'+minute+':'+second);
        setTimeout(function(){Reloj();},1000);
    }
    
    window.onload = function(){
        cargar_cuadro_marcar_asistencia();
        Reloj();
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
                <div>
                    <div id="hora_actual" class="subtitulo2" >
                        
                    </div>
                </div>  
                <div id="cuadro">
                    <!-- Este div usa AJAX para mostrar informacion -->
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