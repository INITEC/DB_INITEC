<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/asistencias_class.php");
        
        $asistencias = new asistencias();
        
?>
		<html>
			<head>
				<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
			</head>
			<body>
				<?php
                
                $hora_asistencia = $_POST["hora_asistencia"];
                $id_persona_env = $_POST["id_persona"];
                $id_reunion = $_POST["id_reunion"];
                $id_cond_asist = $_POST["id_cond_asist"];
                $inasistencia = $_POST["asistencia"];
                
				if($asistencias->nuevo($hora_asistencia, $id_cond_asist, $id_persona_env, $id_reunion, $inasistencia)){
				?>
				<div class="dato_correcto" id="mensaje-cambio-asistencia" >
								SE GUARDARON LOS DATOS CORRECTAMENTE 
				</div>
				<?php 
				} else {
				?>
				<div class="dato_incorrecto" id="mensaje-cambio-asistencia" >
								NO SE HA PODIDO GUARDAR LOS DATOS, ES POSIBLE QUE ESTA ASISTENCIA YA ESTA GUARDADA
				</div>
				<?php 
				}
				?>
				<script>
                    // OJO, es necesario que la pagina contenedora tenga cargado el archivo Jquery
                    // esto debe estar debajo de la creacion del div, si se puede cambiar mejor :)
                    setTimeout(function(){$("#mensaje-cambio-asistencia").slideUp(500)},2000);
                </script>
			</body>
		</html>
<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>