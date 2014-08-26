<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/asistencias_class.php");
        
        $asistencias = new asistencias();
        $integrantes_aux = new integrantes();
        $asistencias_aux = new asistencias();
        $id_reunion = $_POST["id_reunion"];
        $div_ancho = $_POST["div_ancho"];
        
        $num_asistentes = $asistencias->num_asistentes($id_reunion);
        $num_col = (int)($div_ancho/400);
        $num_row = (int)($num_asistentes/$num_col);
        $rest_row = $num_asistentes%$num_col;        
?>
        <table align="center" width="100%" >
            <tr class="tabla2_encabezado" >
                <?php
                for ($i=0; $i<$num_col; $i++){
                ?>
                    <td align="center" valign="top" width="50" >
                        Foto
                    </td>
                    <td align="center" valign="top" width="250" >
                        Nombre
                    </td>
                    <td align="center" valign="top" width="100" >
                        Hora
                    </td>
                    <td align="center" valign="top" width="100" >
                        Asistencia
                    </td>
                    <td align="center" valign="top" width="100" >
                        Condicion
                    </td>
                <?php
                }
                ?>
            </tr>
        <?php
        $asistencias->ver_asistencias($id_reunion);
        //while($dato_asistencia = $asistencias->retornar_SELECT()){
        for($i=0; $i<$num_row; $i++){
            
        ?>
            <tr >
            <?php
            for ($j=0; $j<$num_col; $j++){    
                if($dato_asistencia = $asistencias->retornar_SELECT()){
                    $id_cond_asist = $dato_asistencia["id_cond_asist"];
                    $id_persona_env = $dato_asistencia["id_persona"];
            ?>
                <td class="<?php echo  $asistencias_aux->ver_class_condicion($id_cond_asist);?>" >
                    <img src="<?php echo $integrantes_aux->ver_foto($id_persona_env);?>" width="50" height="40" border="0" >
                </td>
                <td class="<?php echo  $asistencias_aux->ver_class_condicion($id_cond_asist);?>" >
                   <div class="mayuscula" >
                    <?php 
                    echo $integrantes_aux->ver_nombre_corto($id_persona_env);
                    ?>
                    </div>
                </td>
                <td class="<?php echo  $asistencias_aux->ver_class_condicion($id_cond_asist);?>" >
                    <?php 
                    echo $dato_asistencia["hora_asistencia"];
                    ?>
                </td>
                <td class="<?php echo  $asistencias_aux->ver_class_condicion($id_cond_asist);?>" >
                    <?php
                    echo $asistencias_aux->ver_estado_asistencia($id_cond_asist);
                    ?>
                </td>
                <td class="<?php echo  $asistencias_aux->ver_class_condicion($id_cond_asist);?>" >
                    <?php 
                    echo $asistencias_aux->ver_nom_condicion($id_cond_asist);
                    ?>
                </td>
            <?php
                }
            }
            ?>
            </tr>
        <?php 
        }
        ?>
            <tr>
            <?php
            for ($i=0; $i<$rest_row; $i++){
                if($dato_asistencia = $asistencias->retornar_SELECT()){
                    $id_cond_asist = $dato_asistencia["id_cond_asist"];
                    $id_persona_env = $dato_asistencia["id_persona"];
            ?>
                <td class="<?php echo  $asistencias_aux->ver_class_condicion($id_cond_asist);?>" >
                    <img src="<?php echo $integrantes_aux->ver_foto($id_persona_env);?>" width="50" height="40" border="0" >
                </td>
                <td class="<?php echo  $asistencias_aux->ver_class_condicion($id_cond_asist);?>" >
                   <div class="mayuscula" >
                    <?php 
                    echo $integrantes_aux->ver_nombre_corto($id_persona_env);
                    ?>
                    </div>
                </td>
                <td class="<?php echo  $asistencias_aux->ver_class_condicion($id_cond_asist);?>" >
                    <?php 
                    echo $dato_asistencia["hora_asistencia"];
                    ?>
                </td>
                <td class="<?php echo  $asistencias_aux->ver_class_condicion($id_cond_asist);?>" >
                    <?php
                    echo $asistencias_aux->ver_estado_asistencia($id_cond_asist);
                    ?>
                </td>
                <td class="<?php echo  $asistencias_aux->ver_class_condicion($id_cond_asist);?>" >
                    <?php 
                    echo $asistencias_aux->ver_nom_condicion($id_cond_asist);
                    ?>
                </td>  
            <?php
                }
            }
            ?>    
            </tr>
        </table>

<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>