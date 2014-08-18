<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/deudas_class.php");
        
        $deudas = new deudas();
        
?>
		<html>
			<head>
				<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
			</head>
			<body>
				<?php
                $nombre_deuda = $_POST["nombre_deuda"];
                $fecha_final = $_POST["fecha_final"];
                $fecha_creada = $_POST["fecha_creada"];
                $monto_total = $_POST["monto_total"];
                $id_cobrador = $_POST["id_cobrador"];
                $id_grupo = $_POST["id_grupo"];
                
				if($deudas->crear_nueva_deuda ($nombre_deuda, $fecha_final, $fecha_creada, $monto_total, $id_temporada, $id_cobrador, $id_grupo)){
				?>
				<div class="dato_correcto" id="mensaje-nueva-reunion" >
								SE GUARDARON LOS DATOS CORRECTAMENTE 
				</div>
				<?php 
				} else {
				?>
				<div class="dato_incorrecto" id="mensaje-nueva-reunion" >
								HUBO UN ERROR REALIZANDO LA ACCION
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