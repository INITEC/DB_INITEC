<?php
if($acceso == 1) {
	
	if( !empty($_POST)) {
        $id_grupo_env = $_POST["id_grupo_env"];
        $id_persona_env = $_POST["id_persona_env"];
        
        if($integrante->verificar_activo($id_persona_env)) {
            if($grupo->cambiar_estado_integrante($id_persona_env, $id_grupo_env)){
                ?>
                <div class="dato_correcto" id="mensaje-cambio-integrante" >
                    DATO GUARDADO EXITOSAMENTE
                </div>
                <?php
            }else {
                ?>
                <div class="dato_incorrecto" id="mensaje-cambio-integrante" >
                    NO SE HA PODIDO GUARDAR EL DATO
                </div>
                <?php
            }
            ?>
            <script>
                // OJO, es necesario que la pagina contenedora tenga cargado el archivo Jquery
                // esto debe estar debajo de la creacion del div, si se puede cambiar mejor :)
                setTimeout(function(){$("#mensaje-cambio-integrante").slideUp(500)},2000);
            </script>
            <?php
        }
        
        
        
	}
}
?>