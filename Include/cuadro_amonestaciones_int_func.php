<?php
/*  //require 
    $amonestaciones = new amonestaciones();
    $temporadas = new temporadas();
    $url = // es la direccion que abrira la funcino de AJAX
    $width // es el ancho de un cuadrado
    $height // es el alto del cuadro
*/
    function cuadro_amonestaciones_int($amonestaciones, $id_persona, $temporadas, $id_temporada,$width,$height,$url){
                    $num_amonestaciones = $amonestaciones->num_amonestaciones_int($id_persona, $id_temporada);
                    $amonestaciones->ver_id_amonestaciones_int($id_persona, $id_temporada);
                    $max_amonestaciones = $temporadas->ver_max_amonestaciones($id_temporada);
                    $total_amonestaciones = 0;
                ?>

                <table align="center" width="<?php echo $max_amonestaciones*$width; ?>" >
                    <tr >
                       <?php
                        while ($list_amonestaciones = $amonestaciones->retornar_SELECT()){
                            $id_amonestacion = $list_amonestaciones["id_amonestacion"];
                            $id_tipo_amonestacion = $list_amonestaciones["id_tipo_amonestacion"];
                            $peso = $amonestaciones->ver_peso_amonestacion($id_tipo_amonestacion);
                            $total_amonestaciones = $total_amonestaciones + $peso;
                        ?>
                        <td class="amonestacion" width="<?php echo $width*$peso; ?>" height="<?php echo $height; ?>" onmouseover="callDivs_dato ('amonestacion_<?php echo $id_persona?>', '<?php echo $url; ?>', '<?php echo $id_amonestacion?>', 'id_amonestacion')" onClick ="limpiar_elemento('amonestacion_<?php echo $id_persona?>');" >
                            <?php
                            echo $peso;
                            ?>
                        </td>
                        <?php
                        }
                        $amonestaciones_libres = $max_amonestaciones-$total_amonestaciones;
                        if ( $amonestaciones_libres <= 0 ){
                            $new_width = $width*0.5; 
                        }else{
                            $new_width = $width*$amonestaciones_libres;
                        }
                        ?>
                        
                        <td  class="amonestacion_libre" width="<?php echo $new_width; ?>" height="<?php echo $height; ?>">
                        <?php
                            echo $amonestaciones_libres;
                        ?>
                        </td>
                    </tr>
                    <?php
                    if($amonestaciones_libres > 0){
                        $colspan = $num_amonestaciones+$amonestaciones_libres;
                    } else {
                        $colspan = $num_amonestaciones+1;
                    }
                    ?>
                    <tr>
                        <td colspan="<?php echo $colspan; ?>" >
                            <div id="amonestacion_<?php echo $id_persona?>">
                                
                            </div>
                        </td>
                    </tr>
                </table>
<?php 
    }
?>