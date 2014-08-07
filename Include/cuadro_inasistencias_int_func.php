<?php
/*  //require 
    $asistencias = new asistencias();
    $temporadas = new temporadas();
    $url = // es la direccion que abrira la funcino de AJAX
    $width // es el ancho de un cuadrado
    $height // es el alto del cuadro
*/
    function cuadro_inasistencias_int($asistencias, $id_persona, $temporadas, $id_temporada,$width,$height,$url){
                    $num_inasistencias = $asistencias->num_inasistencias_int($id_persona, $id_temporada);
                    $asistencias->ver_inasistencias_int($id_persona, $id_temporada);
                    $max_faltas = $temporadas->ver_max_faltas($id_temporada);
                ?>
                
                <table align="center" width="<?php echo $max_faltas*$width; ?>" >
                    <tr >
                       <?php
                        while ($list_inasistencias = $asistencias->retornar_SELECT()){
                            $id_asistencia = $list_inasistencias["id_asistencia"];
                       ?>
                        <td class="inasistencia" width="<?php echo $width; ?>" height="<?php echo $height; ?>" onmouseover="callDivs_dato ('inasistencia_<?php echo $id_persona?>', '<?php echo $url; ?>', '<?php echo $id_asistencia?>', 'id_asistencia')" onClick ="limpiar_elemento('inasistencia_<?php echo $id_persona?>');" >
                            <?php
                            echo 1;
                            ?>
                        </td>
                        <?php
                        }
                        $inasistencias_libres = $max_faltas-$num_inasistencias;
                        if ( $inasistencias_libres <= 0 ){
                            $new_width = $width*0.5; 
                        }else{
                            $new_width = $width*$inasistencias_libres;
                        }
                        ?>
                        
                        <td  class="inasistencia_libre" width="<?php echo $new_width; ?>" height="<?php echo $height; ?>">
                        <?php
                            echo $inasistencias_libres;
                        ?>
                        </td>
                    </tr>
                    <?php
                    if($inasistencias_libres > 0){
                        $colspan = $num_inasistencias+$inasistencias_libres;
                    } else {
                        $colspan = $num_inasistencias+1;
                    }
                    ?>
                    <tr>
                        <td colspan="<?php echo $colspan; ?>" >
                            <div id="inasistencia_<?php echo $id_persona?>">
                                
                            </div>
                        </td>
                    </tr>
                </table>
<?php 
    }
?>