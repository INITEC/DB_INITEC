<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/reuniones_class.php");
        
        $reuniones = new reuniones();
        
?>
		<html>
			<head>
				<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
			</head>
			<body>
				<?php
                $fecha = $_POST["fecha"];
                $hora_inicio = $_POST["hora_inicio"];
                $hora_final = $_POST["hora_final"];
                $lugar = $_POST["lugar"];
                $asunto = $_POST["asunto"];
                $id_grupo = $_POST["id_grupo"];
                
				if($reuniones->nuevo($fecha, $hora_inicio, $hora_final, $lugar, $asunto, $id_temporada, $id_grupo)){
				?>
				<div class="dato_correcto" id="mensaje-nueva-reunion" >
								SE GUARDARON LOS DATOS CORRECTAMENTE 
				</div>
				<?php 
				} else {
				?>
				<div class="dato_incorrecto" id="mensaje-nueva-reunion" >
								NO SE HA PODIDO GUARDAR LOS DATOS, INTENTE DE NUEVO
				</div>
				<?php 
				}
				?>
				<script>
                    // OJO, es necesario que la pagina contenedora tenga cargado el archivo Jquery
                    // esto debe estar debajo de la creacion del div, si se puede cambiar mejor :)
                    setTimeout(function(){$("#mensaje-nueva-reunion").slideUp(500)},2000);
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