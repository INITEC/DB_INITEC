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
        $id_reunion = $_POST["id_reunion"];
        $datos_reunion = $reuniones->ver_reunion($id_reunion);
        
?>        

    <script>
       
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
                $asistencia = 0;
                $condicion = 0;
                $hora_asistencia = $datos_reunion["hora_inicio"];
                $boton = 1;
            }
                
        ?>
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
                        <select name="asistencia">
                            <option value="1" <?php if($asistencia == 1){echo "selected";} ?> >ASISTIO</option>
                            <option value="2" <?php if($asistencia == 2){echo "selected";} ?> >NO ASISTIO</option>
                        </select>
                    </td>
                    <td>
                        <div id="cuadro-condicion-<?php echo $id_persona_env; ?>" >
                            
                        </div>
                    </td>
                    <td>
                        <?php 
                        if ($boton == 1){
                        ?>
                            
                        <?php
                        }
                        ?>
                    </td>
                </tr>
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