<?php 
session_start();
$id_persona = $_SESSION["id_persona"];
if($id_persona) {
	require_once ("../require/obligaciones_int_class.php");
	require_once ("../require/integrantes_class.php");
	require_once ("../require/trabajos_int_class.php");
	require_once ("../require/tareas_int_class.php");
	
	$tarea_actual = "AD_NOTAS";	
	$obligaciones = new obligaciones_int();
	$integrante = new integrantes();
	$integrante->establecer_integrante($id_persona);
    $id_trabajo = $integrante->retornar_id_trabajo();
    
	if($obligaciones->verificar_tarea($id_trabajo,$tarea_actual)) {
		$trabajos = new trabajos_int();
		$tareas = new tareas_int();
/* ....................................................................... */
?>
<html lang="es">
<head>
    <?php include_once("../Include/head.meta.php"); ?>
    
    <title>..::<?php echo $tarea_actual; ?>::..</title>
    
    <!-- Including general JavaScript and CSS -->
    <?php include_once("../Include/header.general.php"); ?>  

    <link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
    <script type="text/javascript" languaje="javascript" src="../JavaScript/limpiar_elemento.js"></script>
    
    
<script type='text/javascript' languaje='javascript'>
	function cargar_cuadro_examenes (){
        $parametros = {
            'boton-ver-examenes' : true
        };
        $.ajax({
            url: 'AD_notas_aux.php',
            type: 'POST',
            async: true,
            data: $parametros,
            success: function (datos){
                $("#cuadro").html(datos);
            }
        });
    }
    
    window.onload = function(){
	   cargar_cuadro_examenes();
    }
</script>

</head>

<body>
<div id="wrapper">
    
    <!-- Navigation -->
    <?php include_once("../Include/navbar.general.php"); ?>
    
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" ><?php echo $tarea_actual; ?></h1>
                </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
            
            <!-- Container Body -->
			<div class="col-md-12" >
<!-- ******************************************************************** -->
				<div id="cuadro">
                    <!-- Este div usa AJAX para mostrar informacion -->
				</div>
<!-- ******************************************************************* -->
			</div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    
    <div id="pie_pagina_tr">
        <?php include_once("../Include/pie_pagina.php");?>
    </div>
    
</div>
<!-- /#wrapper -->

    
</body>
</html>

<?php 
/* ...................................................................... */
	} else {
        include_once ("../Include/no_tarea.php");
    }	
} else {
    include_once ("../Include/no_acceso.php");
}

?>