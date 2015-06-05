<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/amonestaciones_class.php");
        
        $amonestaciones = new amonestaciones();
        
?>
		<html>
			<head>
				<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
			</head>
			<body>
				<?php
                $listaIntegrantes = explode(",", $_POST["listIntegrantes"]);
                $numIntegrantes = $_POST["numIntegrantes"];
                
                $id_tipo_amonestacion = $_POST["id_tipo_amonestacion"];
                $id_reglamento = $_POST["id_reglamento"];
                $motivo = $_POST["motivo"];
                $fecha_falta = $_POST["fecha_falta"];
                $id_remitente = $id_persona;
                
                
                $estadoGuardado = true;
                for($i=0; $i<$numIntegrantes; $i++){
                    $id_receptor = $listaIntegrantes[$i];
                    if($amonestaciones->nuevo($id_receptor, $id_remitente, $id_tipo_amonestacion, $motivo, $id_reglamento, $id_temporada, $fecha_falta)){
                        //aun nada
                    } else {
                        $estadoGuardado = false;
                    }
                }
                
				if($estadoGuardado){
                    echo "jo".$fecha_falta."ja";
				?>
				<div class="dato_correcto" id="mensaje-cambio-asistencia" >
								SE GUARDARON LOS DATOS CORRECTAMENTE 
				</div>
				<?php 
				} else {
				?>
				<div class="dato_incorrecto" id="mensaje-cambio-asistencia" >
								NO SE HA PODIDO GUARDAR LOS DATOS, ES POSIBLE QUE NO SE HA GUARDADO ALGUNA AMONESTACION
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