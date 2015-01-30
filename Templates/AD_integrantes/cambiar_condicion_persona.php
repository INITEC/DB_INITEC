<?php
if($acceso == 1) {
	
	if( !empty($_POST)) {
        $id_tipo_cond_env = $_POST["id_tipo_cond_env"];
        $id_persona_env = $_POST["id_persona_env"];
        $cond_int = new cond_int();
        
        if($cond_int->cambiar_condicion_persona($id_persona_env, $id_tipo_cond_env)){
            ?>
            <div class="dato_correcto" id="mensaje-cambio-persona" >
                DATO GUARDADO EXITOSAMENTE
            </div>
            <?php
        }else {
            ?>
            <div class="dato_incorrecto" id="mensaje-cambio-persona" >
                NO SE HA PODIDO GUARDAR EL DATO
            </div>
            <?php
        }
        ?>
        <script>
            // OJO, es necesario que la pagina contenedora tenga cargado el archivo Jquery
            // esto debe estar debajo de la creacion del div, si se puede cambiar mejor :)
            setTimeout(function(){$("#mensaje-cambio-persona").slideUp(500)},2000);
        </script>
        <?php
         
	}
}
?>