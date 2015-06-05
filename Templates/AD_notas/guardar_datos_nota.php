<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/notas_class.php");
        
        $notas = new notas();
        
?>
		<html>
			<body>
				<?php
                
                $nota = $_POST["nota"];
                $id_persona_env = $_POST["id_persona"];
                $id_examen = $_POST["id_examen"];
                
				if($notas->nuevo($id_persona_env, $id_examen, $nota)){
				?>
				<div class="bg-success" id="mensaje-cambio-nota" >
								SE GUARDARON LOS DATOS CORRECTAMENTE 
				</div>
				<?php 
				} else {
				?>
				<div class="bg-danger" id="mensaje-cambio-nota" >
								NO SE HA PODIDO GUARDAR LOS DATOS, ES POSIBLE QUE ESTA ASISTENCIA YA ESTA GUARDADA
				</div>
				<?php 
				}
				?>
				<script>
                    // OJO, es necesario que la pagina contenedora tenga cargado el archivo Jquery
                    // esto debe estar debajo de la creacion del div, si se puede cambiar mejor :)
                    setTimeout(function(){$("#mensaje-cambio-nota").slideUp(500)},2000);
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