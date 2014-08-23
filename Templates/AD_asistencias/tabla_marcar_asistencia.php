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
        
        function enviar_asistencia (id_form, div_respuesta){
            $url = "AD_asistencias_aux.php";
            $.ajax({
                type: "POST",
                url: $url,
                data: $(id_form).serialize(),
                success: function(data){
                    $(div_respuesta).html(data);
                }
            });
            setTimeout(function(){cargar_cuadro_marcar_asistencia ();},3000);
            return false;
        }
        
        function marcar_asistencia (id_form, div_respuesta) {
            // esta funcion puede mejorar si se considera en cada temporada los tiempos maximos de tardanza y asistencia
            $max_puntual = 15; // tiempo en minutos
            $max_asistencia = 30; // tiempo en minutos
            var formulario = document.getElementById(id_form);
            //var hora_inicio = <?php echo $datos_reunion["hora_final"];?>;
            var now = new Date(); 
            var hour = now.getHours();
            var minute = now.getMinutes();
            var second = now.getSeconds();
            var hora_actual = hour+':'+minute+':'+second;
            
            //var inicio=hora_inicio.split(":");
            //formulario.hora_asistencia.value = hora_actual;
            
        }
        
        /*$(function(){
            $("#boton-crear").click(function(){
                $url = "AD_reuniones_aux.php";
                $.ajax({
                    type: "POST",
                    url: $url,
                    data: $("#nueva_reunion").serialize(),
                    success: function(data){
                        $("#resultado_nueva_reunion").html(data);
                    }
                });
                setTimeout(function(){cargar_cuadro_reuniones();},3000);
                return false;
            });
        });
        
        function cargar_cuadro_reuniones (){
            $boton = "ver_reuniones";
            $parametros = {'boton-ver-reuniones' : $boton};
            $.ajax({
                url: 'AD_asistencias_aux.php',
                type: 'POST',
                async: true,
                data: $parametros,
                success: function (datos){
                    $("#cuadro").html(datos);
                }
            });
        }*/

    </script>
               
    <div class="subtitulo3" >
        Toma de Asistencia (<?php echo fecha_text($reuniones->ver_fecha_reunion($datos_reunion["id_reunion"]));?>)
    </div>
    <div class="subtitulo1" >
        Hora Inicio: <?php echo $datos_reunion["hora_inicio"];?> - Hora Final: <?php echo $datos_reunion["hora_final"];?>
    </div>
    <br>
    <table align="center" >
        <tr class="tabla1_encabezado" >
            <td >
                Foto
            </td>
            <td >
                Nombre
            </td>
            <td >
                Hora
            </td>
            <td >
                Asistencia
            </td>
            <td >
                Condicion
            </td>
            <td >
            
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
                <form id="asistencia_<?php echo $id_persona_env;?>" method="POST">
                    <tr class="<?php echo $class; ?>" >
                        <td>
                            <img src="<?php echo $integrantes_aux->ver_foto($id_persona_env); ?>" width="50" height="40" >
                        </td>
                        <td>
                            <?php echo $integrantes_aux->ver_nombre_corto($id_persona_env); ?>
                        </td>
                        <td>
                            <input type="text" name="hora_asistencia" value="<?php echo $hora_asistencia;?>" >
                        </td>
                        <td>
                            <select name="asistencia" id="asistencia_<?php echo $id_persona_env;?>" onchange="actualizar_cuadro_condicion('#asistencia_<?php echo $id_persona_env;?>','#cuadro-condicion-<?php echo $id_persona_env; ?>', '<?php echo $condicion;?>')" >
                                <option value="1" <?php if($asistencia == 1){echo "selected";} ?> >ASISTIO</option>
                                <option value="2" <?php if($asistencia == 2){echo "selected";} ?> >NO ASISTIO</option>
                            </select>
                        </td>
                        <td>   
                            <div id="cuadro-condicion-<?php echo $id_persona_env; ?>" >
                            <select name="id_cond_asist">    
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
                        <td>
                            <?php 
                            if ($boton == 2){
                            ?>
                                <input type="hidden" name="boton-enviar-asistencia" value="boton">
                                <input type="button" value="Enviar" title="Enviar" >
                                <input type="button" value="Marcar" title="Marcar" onclick="marcar_asistencia('asistencia_<?php echo $id_persona_env;?>','cuadro-condicion-<?php echo $id_persona_env; ?>')" >
                            <?php
                            } else {
                            ?>
                                <input type="hidden" name="boton-cambiar-asistencia" value="boton">
                                <input type="button" value="Cambiar" title="Cambiar" >
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                </form>
                <tr>
                    <td colspan="6">
                        <div id="respuesta_marcar_asistencia_<?php echo $id_persona_env;?>" >
                            
                        </div>
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