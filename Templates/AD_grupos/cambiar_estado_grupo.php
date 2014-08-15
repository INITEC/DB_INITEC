<?php
if($acceso == 1) {
	
	if( !empty($_POST)) {
        $id_grupo_env = $_POST["id_grupo_env"];
        $grupos = new grupos();
        
        if($grupos->cambiar_estado_grupo($id_grupo_env)){
            ?>
            <div class="dato_correcto" id="mensaje-cambio-grupo" >
                DATO GUARDADO EXITOSAMENTE
            </div>
            <?php
        }else {
            ?>
            <div class="dato_incorrecto" id="mensaje-cambio-grupo" >
                NO SE HA PODIDO GUARDAR EL DATO
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
}
?>