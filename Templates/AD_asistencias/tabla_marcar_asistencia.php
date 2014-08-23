<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/reuniones_class.php");
        require_once ("../require/lista_grupos_class.php");
        require_once ("../require/asistencias_class.php");
        require_once ("../require/fecha_text_func.php");
        
        $reuniones = new reuniones();
        $lista_grupos = new lista_grupos();
        $integrantes_aux = new integrantes();
        $asistencias = new asistencias();
        $cond_asist = new cond_asist();
        $id_reunion = $_POST["id_reunion"];
        $datos_reunion = $reuniones->ver_reunion($id_reunion);
        
?>        

    <script>
        function actualizar_cuadro_condicion (select, div_respuesta, condicion ){
            $asistencia = $(select).val();
            $condicion = condicion;
            $parametros = {
                'boton-actualizar-cuadro-condicion' : true,
                'asistencia' : $asistencia,
                'condicion' : $condicion
            }
            $.ajax({
                url: 'AD_asistencias_aux.php',
                type: 'POST',
                async: true,
                data: $parametros,
                success: function (datos){
                    $(div_respuesta).html(datos);
                }
            });
        }
        
        function enviar_asistencia (id_form, id_div){
            $url = "AD_asistencias_aux.php";
            $.ajax({
                type: "POST",
                url: $url,
                data: $(id_form).serialize(),
                success: function(data){
                    $(id_div).html(data);
                }
            });
            setTimeout(function(){cargar_cuadro_marcar_asistencia ();},3000);
            return false;
        }
        
        function marcar_asistencia (id_form, id_div, select, div_respuesta) {
            /* esta funcion puede mejorar si se considera en cada temporada los tiempos maximos de tardanza y asistencia */
            $max_puntual = 15;  // tiempo en minutos
            $max_asistencia = 30; // tiemmpo en minutos
            
            var hora_inicio = "<?php echo $datos_reunion["hora_inicio"];?>";
            var now = new Date(); 
            var hour = now.getHours();
            var minute = now.getMinutes();
            var second = now.getSeconds();
            hour = ( hour < 10 )? "0"+hour : hour;
            minute = ( minute < 10 )? "0"+minute : minute;
            second = ( second < 10 )? "0"+second : second;
            var hora_actual = hour+':'+minute+':'+second;
            
            var inicio=hora_inicio.split(":");
            var time_inicio = (inicio[0]*60)+ +inicio[1];
            var time_ahora = (hour*60)+ +(minute);
            var retardo = time_ahora - time_inicio;
            
            if(retardo > $max_asistencia){
                $(id_form+" :input[name='hora_asistencia']").val('');
                $(id_form+" :input[name='asistencia']").val(2);
                actualizar_cuadro_condicion (select, div_respuesta,'5')
            } else if (retardo <= $max_asistencia && retardo > $max_puntual ){
                $(id_form+" :input[name='hora_asistencia']").val(hora_actual);
                $(id_form+" :input[name='asistencia']").val(1);
                actualizar_cuadro_condicion (select, div_respuesta,'3')
            } else if (retardo <= $max_puntual && retardo >= 0){
                $(id_form+" :input[name='hora_asistencia']").val(hora_actual);
                $(id_form+" :input[name='asistencia']").val(1);
                actualizar_cuadro_condicion (select, div_respuesta,'1')
            } else if (retardo < 0){
                $(id_form+" :input[name='hora_asistencia']").val(hora_inicio);
                $(id_form+" :input[name='asistencia']").val(1);
                actualizar_cuadro_condicion (select, div_respuesta,'1')
            }
            setTimeout(function(){enviar_asistencia (id_form, id_div);},200);
            
        }
        
    </script>
                                            
    <div class="subtitulo3" >
        Toma de Asistencia (<?php echo fecha_text($reuniones->ver_fecha_reunion($datos_reunion["id_reunion"]));?>)
    </div>
    <div class="subtitulo1" >
        Hora Inicio: <?php echo $datos_reunion["hora_inicio"];?> - Hora Final: <?php echo $datos_reunion["hora_final"];?>
    </div>
    <br>
    <table align="center" width="95%" cellpadding="0" cellspacing="0" >
        <tr class="tabla1_encabezado" >
            <td width="50" >
                Foto
            </td>
            <td width="200" >
                Nombre
            </td>
            <td width="180" >
                Hora
            </td>
            <td width="110" >
                Asistencia
            </td>
            <td width="130" >
                Condición
            </td>
            <td width="140" >
            
            </td>
        </tr>
        <?php
        $lista_grupos->ver_integrantes($datos_reunion["id_grupo"]);
        while ($dato_grupo = $lista_grupos->retornar_SELECT() ){
            $id_persona_env = $dato_grupo["id_persona"];
            if($asistencias->verificar_asistencia($id_persona_env, $id_reunion) != 0){
                $dato_asistencia = $asistencias->ver_asistencia_int($id_persona_env,$id_reunion);
                $class = $asistencias->ver_class_condicion($dato_asistencia["id_cond_asist"]);
                $hora_asistencia = $dato_asistencia["hora_asistencia"];
                $inasistencia = $dato_asistencia["inasistencia"];
                if ($inasistencia == 1 || $inasistencia == 3){
                    $asistencia = 2;
                }else {
                    $asistencia = 1;
                }
                $condicion = $dato_asistencia["id_cond_asist"];
                $boton = 2;
            } else {
                $class = "tabla1_informacion";
                $asistencia = 1;
                $condicion = 0;
                $hora_asistencia = $datos_reunion["hora_inicio"];
                $boton = 1;
            }
                
        ?>
                <tr>
                    <td colspan="6" >
                <form id="asistencia<?php echo $id_persona_env;?>" method="POST">
                    <table width="100%" cellpadding="0" cellspacing="0" >
                    <tr class="<?php echo $class; ?>" >
                        <td width="50" >
                            <img src="<?php echo $integrantes_aux->ver_foto($id_persona_env); ?>" width="50" height="40" >
                        </td>
                        <td width="200" class="mayuscula" >
                            <?php echo $integrantes_aux->ver_nombre_corto($id_persona_env); ?>
                        </td>
                        <td width="180" >
                            <input type="text" name="hora_asistencia" id="hora_asistencia" value="<?php echo $hora_asistencia;?>" >
                        </td>
                        <td width="110" >
                            <select name="asistencia" id="asist_<?php echo $id_persona_env;?>" onchange="actualizar_cuadro_condicion('#asist_<?php echo $id_persona_env;?>','#cuadro-condicion-<?php echo $id_persona_env; ?>', '<?php echo $condicion;?>')" >
                                <option value="1" <?php if($asistencia == 1){echo "selected";} ?> >ASISTIO</option>
                                <option value="2" <?php if($asistencia == 2){echo "selected";} ?> >NO ASISTIO</option>
                            </select>
                        </td>
                        <td width="130" >   
                            <div id="cuadro-condicion-<?php echo $id_persona_env; ?>" >
                            <select name="id_cond_asist" id="id_cond_asist" >    
                                <?php
                                $cond_asist->ver_condiciones($asistencia);
                                while ($dato_condicion = $cond_asist->retornar_SELECT()){
                                ?>
                                <option value="<?php echo $dato_condicion["id_cond_asist"];?>" <?php if($dato_condicion["id_cond_asist"] == $condicion ) {echo "selected";} ?> > <?php echo $dato_condicion["nom_condicion"]; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                            </div>
                        </td>
                        <td width="140" >
                            <?php 
                            if ($boton == 1){
                            ?>
                                <input type="hidden" name="boton-enviar-asistencia" value="boton" >
                                <input type="button" value="Enviar" title="Enviar" onclick="enviar_asistencia('#asistencia<?php echo $id_persona_env;?>','#respuesta_marcar_asistencia_<?php echo $id_persona_env;?>')" >
                                <input type="button" value="Marcar" title="Marcar" onclick="marcar_asistencia('#asistencia<?php echo $id_persona_env;?>','#respuesta_marcar_asistencia_<?php echo $id_persona_env;?>','#asist_<?php echo $id_persona_env;?>','#cuadro-condicion-<?php echo $id_persona_env; ?>')" >
                            <?php
                            } else {
                            ?>
                                <input type="hidden" name="id_asistencia" value="<?php echo $dato_asistencia["id_asistencia"]; ?>" >
                                <input type="hidden" name="boton-cambiar-asistencia" value="boton">
                                <input type="button" value="Cambiar" title="Cambiar" onclick="enviar_asistencia('#asistencia<?php echo $id_persona_env;?>','#respuesta_marcar_asistencia_<?php echo $id_persona_env;?>')" >
                            <?php
                            }
                            ?>
                                <input type="hidden" name="id_persona" value="<?php echo $id_persona_env; ?>" >
                                <input type="hidden" name="id_reunion" value="<?php echo $id_reunion; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <div id="respuesta_marcar_asistencia_<?php echo $id_persona_env;?>" >

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