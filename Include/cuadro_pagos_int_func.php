<?php
/*  //require 
    $pagos = new pagos();
    $cond_pagos = new cond_pagos();
    $url = // es la direccion que abrira la funcino de AJAX
    $width // es el ancho de un cuadrado
    $height // es el alto del cuadro
*/
    function cuadro_pagos_int($pagos, $id_persona, $pagos_aux, $id_temporada,$width,$height,$url,$ajax=1){
                    $num_pagos = $pagos->num_pagos_int($id_persona, $id_temporada);
                    $pagos->ver_pagos_int($id_persona, $id_temporada);
                ?>
                
                <table align="center" width="<?php echo $num_pagos*$width; ?>" >
                    <tr >
                       <?php
                        if($num_pagos==0){
                        ?>
                        <td bgcolor="#FFFFFF" width="<?php echo $width; ?>" height="<?php echo $height; ?>" align="center" >
                            0
                        </td>
                        <?php
                        }
                        ?>
                       
                       <?php
                        while ($list_pagos = $pagos->retornar_SELECT()){
                            $id_pago = $list_pago["id_pago"];
                       ?>
                        <td class="<?php echo $pagos_aux->ver_class_cond($list_pagos["id_cond_pago"]);?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" align="center" <?php if($ajax == 1){?> onmouseover="callDivs_dato ('pagos_<?php echo $id_persona;?>', '<?php echo $url; ?>', '<?php echo $id_pago;?>', 'id_pago')" <?php } ?> onClick ="limpiar_elemento('pago_<?php echo $id_persona;?>');" >
                            <?php
                            //echo 1;
                            ?>
                        </td>
                        <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td colspan="<?php echo $num_pagos; ?>" >
                            <div id="pagos_<?php echo $id_persona?>">
                                
                            </div>
                        </td>
                    </tr>
                </table>
<?php 
    }
?>