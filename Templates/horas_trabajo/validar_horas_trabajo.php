<?php 
if($acceso == 1) {
?>
<html>
	<head>
	<title>..::<?php echo $tarea_actual; ?>::..</title>
	<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
	<script type="text/javascript" language="javascript" src="../JavaScript/validacion_input_1.js" ></script>
    <script src="http://code.jquery.com/jquery-1.11.1.js"></script>
	
	<script type='text/javascript' languaje='javascript'>
        function cuadro_horas_trabajo (){
            $id_grupo = $("#id_grupo").val();
            $parametros = {
                'boton-ver-horas-trabajo-grupo' : true,
                'id_grupo' : $id_grupo
            };
            
            $.ajax({
                url: 'horas_trabajo_aux.php',
                type: 'POST',
                async: true,
                data: $parametros,
                success: function (datos){
                    $("#cuadro").html(datos);
                }
            });
        };
        
        $(function(){
            $("#id_grupo").change(function(){
                $id_grupo = $("#id_grupo").val();
                if($id_grupo == ""){
                    $("#cuadro").empty();
                } else {
                    cuadro_horas_trabajo();
                }
            });
        });
        
        window.onload = function(){
            $id_grupo = $("#id_grupo").val();
            if($id_grupo == ""){
                $("#cuadro").empty();
            } else {
                cuadro_horas_trabajo();
            }
        };
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
				<div>
					<div>
						<table align="center">
							<tr id="tabla1_encabezado">
								<td>
									ELIJA GRUPO DE VALIDACION
								</td>
							</tr>
							<tr id="tabla1_informacion">
								<form action="javascript:void(0);" id="form_grupo">
									<input type="hidden" name="select_grupo" value="1">
								<td>
									<select name="id_grupo" id="id_grupo" onchange="eval_select('id_grupo')">
										<?php
                                            if($grupo->num_grupos_encargado($id_persona)==0){
                                        ?>
                                        <option value="">Ningun grupo</option>
                                        <?php
                                            }
                                        ?>
										
										<?php  												
											$grupo->ver_grupos_encargado($id_persona);
											while($op_grupo = $grupo->retornar_SELECT()) {
										?>
										<option value="<?php echo $op_grupo['id_grupo'];?>"><?php echo $op_grupo['nom_grupo']?></option>
										<?php }?>
									</select>
								</td>
								</form>
							</tr>
						</table>
					</div>
					<hr>
					<div id="cuadro">
					    <!-- Aca aparecera la respuesta del ajax -->
					</div>
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