<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        $grupos = new grupos();
        
?>
		<html>
			<head>
				<link href="../Estilos/tareas_estilo.css" type="text/css" rel="stylesheet" >
			</head>
			<body>
				<?php
                $id_grupo = $_POST["id_grupo"];
                $nom_grupo = $_POST["nom_grupo"];
                $encargado = $_POST["encargado"];
                if($integrante->verificar_activo($encargado)) {
                    if($grupos->cambio($id_grupo, $nom_grupo, $encargado)){
                    ?>
                    <div class="dato_correcto" id="mensaje-cambio-grupo" >
                                    SE GUARDARON LOS DATOS CORRECTAMENTE 
                    </div>
                    <?php 
                    } else {
                    ?>
                    <div class="dato_incorrecto" id="mensaje-cambio-grupo" >
                                    NO SE HA PODIDO GUARDAR LOS DATOS, INTENTE DE NUEVO
                    </div>
                    <?php 
                    }
                    ?>
                    <script>
                        // OJO, es necesario que la pagina contenedora tenga cargado el archivo Jquery
                        // esto debe estar debajo de la creacion del div, si se puede cambiar mejor :)
                        setTimeout(function(){$("#mensaje-cambio-grupo").slideUp(500)},2000);
                    </script>
                <?php
                }
                ?>
			</body>
		</html>
<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>