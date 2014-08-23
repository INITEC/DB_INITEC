<?php
if($acceso == 1) {
?>

<html>
<head>
<title>..::<?php echo $tarea_actual; ?>::..</title>
<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
<script type="text/javascript" languaje="javascript" src="home/home_editar.js"></script>
<script src="http://code.jquery.com/jquery-1.11.1.js"></script>

<script type='text/javascript' languaje='javascript'>
	function cargar_cuadro_editar_integrante (){
        $parametros = {
            'boton-ver-cuadro-editar-integrante' : true
        };
        $.ajax({
            url: 'home_aux.php',
            type: 'POST',
            async: true,
            data: $parametros,
            success: function (datos){
                $("#cuadro").html(datos);
            }
        });
    }
    
    window.onload = function(){
	   cargar_cuadro_editar_integrante();
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
				<form id="datos_integrante" action="javascript:void(0);" method="POST" enctype="multipart/form-data" >
                    <div id="cuadro">
                        <!-- Este div usa AJAX para mostrar informacion -->
                    </div>
				</form>
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
}
?>