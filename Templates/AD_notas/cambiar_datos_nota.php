<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/notas_class.php");
        
        $notas = new notas();
        
?>
		<html>
			<head>
				<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
			</head>
			<body>
				<?php
                $id_nota = $_POST["id_nota"];
                $nota = $_POST["nota"];
                $id_persona_env = $_POST["id_persona"];
                $id_reunion = $_POST["id_reunion"];
                
				if($notas->cambio($id_nota, $nota)){
				?>
				<div class="bg-success" id="mensaje-cambio-nota" >
								SE GUARDARON LOS DATOS CORRECTAMENTE 
				</div>
				<?php 
				} else {
				?>
				<div class="bg-danger" id="mensaje-cambio-nota" >
								NO SE HA PODIDO GUARDAR LOS DATOS, INTENTE DE NUEVO
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