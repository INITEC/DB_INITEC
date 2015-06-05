<?php
/*  //require 
    $pagos = new pagos();
    $cond_pagos = new cond_pagos();
    $url = // es la direccion que abrira la funcino de AJAX
    $width // es el ancho de un cuadrado
    $height // es el alto del cuadro
*/
    function cuadro_notas_int($notas, $id_persona, $notas_aux, $id_temporada,$width,$height,$url,$ajax=1){
        
        $num_notas = $notas->num_notas_int($id_persona, $id_temporada);
        $notas->ver_notas_int($id_persona, $id_temporada);
                ?>
                
                <table align="center" width="<?php echo $num_notas*$width; ?>" >
                    <tr >
                       <?php
                        if($num_notas==0){
                        ?>
                        <td bgcolor="#FFFFFF" width="<?php echo $width; ?>" height="<?php echo $height; ?>" align="center" >
                            -
                        </td>
                        <?php
                        }
                        ?>
                       
                       <?php
                        while ($list_notas = $notas->retornar_SELECT()){
                            $id_nota = $list_notas["id_nota"];
                            $condicion = $list_notas["condicion"];
                            $nota = $list_notas["nota"];
                            if ($condicion == 1){
                                $class = "inasistencia_libre";
                            }else {
                                $class = "inasistencia";
                            }
                       ?>
                        <td class="<?php echo $class;?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" align="center">
                            <?php
                            echo $nota;
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

