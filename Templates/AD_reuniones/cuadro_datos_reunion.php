<?php 
if($acceso == 1) {

    if( !empty($_POST)){
        
        require_once ("../require/reuniones_class.php");
        require_once ("../require/grupos_class.php");
        require_once ("../require/fecha_text_func.php");
        
        $reuniones = new reuniones();
        $grupos = new grupos();
        $id_reunion = $_POST["id_reunion"];
        $datos_reunion = $reuniones->ver_reunion($id_reunion);
        
?>
        <table align="center" width="400" >
            <tr class="tabla2_encabezado" >
                <td colspan="2" >
                    <?php echo fecha_text($reuniones->ver_fecha_reunion($datos_reunion["id_reunion"])); ?>    
                </td>
            </tr>
                <tr>
                <td class="tabla2_encabezado" >
                    Hora de inicio:
                </td>
                <td class="tabla2_informacion" >
                    <?php echo $datos_reunion["hora_inicio"]; ?>
                </td>
            </tr>
            <tr>
                <td class="tabla2_encabezado" >
                    Hora de finalizacion:
                </td>
                <td class="tabla2_informacion" >
                    <?php echo $datos_reunion["hora_final"]; ?>
                </td>
            </tr>
            <tr>
                <td class="tabla2_encabezado" >
                    Grupo
                </td>
                <td class="tabla2_informacion" >
                    <?php echo $grupos->ver_nom_grupo($datos_reunion["id_grupo"]);?>
                </td>
            </tr>
            <tr class="tabla2_encabezado" >
                <td colspan="2" >
                    Lugar:
                </td>
            </tr>
            <tr class="tabla2_informacion" >
                <td colspan="2" >
                    <?php echo $datos_reunion["lugar"]; ?>
                </td>
            </tr>
            <tr class="tabla2_encabezado" >
                <td colspan="2" >
                    Asunto:
                </td>
            </tr>
            <tr class="tabla2_informacion" >
                <td colspan="2" >
                    <p>
                        <?php echo $datos_reunion["asunto"]; ?>
                    </p>
                </td>
            </tr>
        </table>
<?php		
    }
    else {
        echo "No se han recibido correctamente los datos.";
    }
}
?>