<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/notas_class.php");
        require_once ("../require/examenes_class.php");
        require_once ("../require/fecha_text_func.php");
        require_once ("../require/lista_grupos_class.php");
        
        $examenes = new examenes();
        $notas = new notas();
        $integrantes_aux = new integrantes();
        $lista_grupos = new lista_grupos();
        $id_examen = $_POST["id_examen"];
        $datos_examen = $examenes->ver_examen($id_examen);
        
?>        

    <script>
        
        function enviar_nota (id_form, id_div){
            $url = "AD_notas_aux.php";
            $.ajax({
                type: "POST",
                url: $url,
                data: $(id_form).serialize(),
                success: function(data){
                    $(id_div).html(data);
                }
            });
            setTimeout(function(){cargar_cuadro_marcar_notas();},1000);
            return false;
        }
        
    </script>
                                            
    <div class="subtitulo3" >
        <?php echo $datos_examen["examen"];?>
    </div>
    <br>
    <table align="center" width="95%" cellpadding="0" cellspacing="0" >
        <tr class="tabla1_encabezado" >
            <td>
                No
            </td>
            <td width="50" >
                Foto
            </td>
            <td width="200" >
                Nombre
            </td>
            <td width="180" >
                Nota
            </td>
            <td width="140" >
            
            </td>
        </tr>
        <?php
        $lista_grupos->ver_integrantes($datos_examen["id_grupo"]);
        $cont_int = 0;
        while ($dato_grupo = $lista_grupos->retornar_SELECT() ){
            $id_persona_env = $dato_grupo["id_persona"];
            $cont_int++;
            if($notas->verificar_nota($id_persona_env, $id_examen) != 0){
                $dato_nota = $notas->ver_nota_int($id_persona_env,$id_examen);
                $condicion = $notas->ver_condicion($dato_nota["id_nota"]);
                if($condicion == 1){
                    $class = "success";
                } elseif ($condicion == 0){
                    $class = "danger";
                }else {
                    $class = "active";
                }
                
                $nota_examen = $dato_nota["nota"];
                $boton = 2;
            } else {
                $class = "active";
                $nota_examen = 10;
                $boton = 1;
            }
                
        ?>
                <tr>
                    <td colspan="5" >
                <form id="nota<?php echo $id_persona_env;?>" method="POST">
                    <table class="table" width="100%" cellpadding="0" cellspacing="0" >
                    <tr class="<?php echo $class; ?>" >
                        <td width="30" >
                            <?php echo $cont_int; ?>
                        </td>
                        <td width="50" >
                            <img src="<?php echo $integrantes_aux->ver_foto($id_persona_env); ?>" width="50" height="40" >
                        </td>
                        <td width="200" class="mayuscula" >
                            <?php echo $integrantes_aux->ver_nombre_corto($id_persona_env); ?>
                        </td>
                        <td width="180" >
                            <input type="text" name="nota" id="nota" value="<?php echo $nota_examen;?>" >
                        </td>
                        <td width="140" >
                            <?php 
                            if ($boton == 1){
                            ?>
                                <input type="hidden" name="boton-enviar-nota" value="boton" >
                                <input type="button" value="Enviar" title="Enviar" onclick="enviar_nota('#nota<?php echo $id_persona_env;?>','#respuesta_marcar_nota_<?php echo $id_persona_env;?>')" >
                            <?php
                            } else {
                            ?>
                                <input type="hidden" name="id_nota" value="<?php echo $dato_nota["id_nota"]; ?>" >
                                <input type="hidden" name="boton-cambiar-nota" value="boton">
                                <input type="button" value="Cambiar" title="Cambiar" onclick="enviar_nota('#nota<?php echo $id_persona_env;?>','#respuesta_marcar_nota_<?php echo $id_persona_env;?>')" >
                            <?php
                            }
                            ?>
                                <input type="hidden" name="id_persona" value="<?php echo $id_persona_env; ?>" >
                                <input type="hidden" name="id_examen" value="<?php echo $id_examen; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            <div id="respuesta_marcar_nota_<?php echo $id_persona_env;?>" >

                            </div>
                        </td>
                    </tr>
                    </table>
                </form>
                    </td>
                </tr>
        <?php
        }
        ?>
    </table>
   
<?php	
    
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>